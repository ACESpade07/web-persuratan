<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 🔥 Statistik
        $totalMasuk = SuratMasuk::count();
        $totalKeluar = SuratKeluar::count();
        $totalSemua = $totalMasuk + $totalKeluar;

        // 🔥 Data gabungan
        $masuk = SuratMasuk::get()->map(function ($item) {
            $item->jenis = 'Masuk';
            $item->kontak = $item->pengirim;
            return $item;
        });

        $keluar = SuratKeluar::get()->map(function ($item) {
            $item->jenis = 'Keluar';
            $item->kontak = $item->tujuan; // 🔥 PERBAIKAN (bukan pengirim)
            return $item;
        });

        $dataGabungan = collect()
            ->concat($masuk)
            ->concat($keluar)
            ->sortByDesc('tanggal_surat')
            ->values();

        // 🔥 PAGINATION
        $page = $request->get('page', 1);
        $perPage = 5;

        $total = $dataGabungan->count();
        $dataPage = $dataGabungan->forPage($page, $perPage);

        return view('dashboard', [
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'totalSemua' => $totalSemua,
            'dataGabungan' => $dataPage, // 🔥 pakai ini
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page
        ]);
    }

}
