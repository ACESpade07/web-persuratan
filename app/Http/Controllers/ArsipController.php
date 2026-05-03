<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Exports\ArsipExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class ArsipController extends Controller
{
    private function getData(Request $request): Collection
    {
        $tahun  = $request->tahun;
        $bulan  = $request->bulan;
        $jenis  = $request->jenis;
        $search = $request->search;

        return Arsip::query()
            ->when($tahun,  fn($q) => $q->whereRaw("strftime('%Y', tanggal_surat) = ?", [$tahun]))
            ->when($bulan,  fn($q) => $q->whereRaw("strftime('%m', tanggal_surat) = ?", [str_pad($bulan, 2, '0', STR_PAD_LEFT)]))
            ->when($jenis,  fn($q) => $q->where('jenis', $jenis))
            ->when($search, fn($q) => $q->where('nomor_surat', 'like', "%$search%")
                                        ->orWhere('kontak', 'like', "%$search%")
                                        ->orWhere('perihal', 'like', "%$search%"))
            ->orderByDesc('tanggal_surat')
            ->get()
            ->map(fn($item) => (object)[
                'id'            => $item->id,
                'nomor_surat'   => $item->nomor_surat,
                'jenis'         => $item->jenis,
                'kontak'        => $item->kontak,
                'perihal'       => $item->perihal,
                'tanggal_surat' => $item->tanggal_surat,
                'file'          => $item->file,
            ]);
    }

    public function index(Request $request)
    {
        $data   = $this->getData($request);
        $tahun  = $request->tahun;
        $bulan  = $request->bulan;
        $jenis  = $request->jenis;
        $search = $request->search;

        $totalMasuk  = $data->where('jenis', 'Masuk')->count();
        $totalKeluar = $data->where('jenis', 'Keluar')->count();

        $tahunList = Arsip::selectRaw("strftime('%Y', tanggal_surat) as tahun")
            ->distinct()
            ->pluck('tahun')
            ->filter()
            ->sortDesc();

        return view('arsip.index', compact(
            'data', 'tahun', 'bulan', 'jenis', 'search',
            'totalMasuk', 'totalKeluar', 'tahunList'
        ));
    }

    public function exportPdf(Request $request)
    {
        $data  = $this->getData($request);
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $pdf = Pdf::loadView('arsip.pdf', compact('data', 'tahun', 'bulan'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('arsip-surat-' . now()->format('Ymd') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->getData($request);
        return Excel::download(
            new ArsipExport($data),
            'arsip-surat-' . now()->format('Ymd') . '.xlsx'
        );
    }
}