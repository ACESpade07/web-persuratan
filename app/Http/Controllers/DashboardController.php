<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 🔍 Ambil keyword dari input
        $search = $request->get('search');

        // 🔥 Statistik
        $totalMasuk = SuratMasuk::count();
        $totalKeluar = SuratKeluar::count();
        $totalSemua = $totalMasuk + $totalKeluar;

        // 🔹 Surat Masuk
        $masuk = SuratMasuk::get()->map(function ($item) {
            $item->jenis = 'Masuk';
            $item->kontak = $item->pengirim;
            return $item;
        });

        // 🔹 Surat Keluar
        $keluar = SuratKeluar::get()->map(function ($item) {
            $item->jenis = 'Keluar';
            $item->kontak = $item->tujuan;
            return $item;
        });

        // 🔹 Gabungkan
        $dataGabungan = collect()
            ->concat($masuk)
            ->concat($keluar);

        // 🔥 FILTER SEARCH
        if ($search) {
            $keyword = trim(strtolower($search));

            $dataGabungan = $dataGabungan->filter(function ($item) use ($keyword) {
                return  str_contains(trim(strtolower($item->nomor_surat ?? '')), $keyword) ||
                        str_contains(trim(strtolower($item->kontak ?? '')), $keyword) ||
                        str_contains(trim(strtolower($item->perihal ?? '')), $keyword);
            });
        }

        // 🔹 Urutkan
        $dataGabungan = $dataGabungan
            ->sortByDesc('tanggal_surat')
            ->values();

        // 🔥 Pagination
        $page = $request->get('page', 1);
        $perPage = 5;

        $total = $dataGabungan->count();
        $dataPage = $dataGabungan->forPage($page, $perPage);

        return view('dashboard', [
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'totalSemua' => $totalSemua,
            'dataGabungan' => $dataPage,
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
            'search' => $search
        ]);
    }

}
