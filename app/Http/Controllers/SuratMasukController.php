<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class SuratMasukController extends Controller
{
     public function index()
    {
        $data = SuratMasuk::all();
        return view('surat_masuk.index', compact('data'));
    }

    

    public function create()
    {
        return view('surat_masuk.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $namaFile = null;

        if ($file) {
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);
        }

        SuratMasuk::create([
            'nomor_surat' => $this->generateNomorSurat(), // 🔥 otomatis
            'pengirim' => $request->pengirim,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'file' => $namaFile
        ]);

        return redirect()->route('surat-masuk.index');
    }

        public function show($id)
    {
        $data = \App\Models\SuratMasuk::findOrFail($id);
        return view('surat_masuk.show', compact('data'));
    }

    private function generateNomorSurat()
    {
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        $bulan = date('n');
        $tahun = date('Y');

        // Hitung jumlah surat bulan & tahun ini
        $count = \App\Models\SuratMasuk::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->count();

        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        return $nomorUrut . '/IMIGRASI/' . $bulanRomawi[$bulan] . '/' . $tahun;
    }

    public function edit($id)
    {
        $data = SuratMasuk::findOrFail($id);
        return view('surat_masuk.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_masuk,nomor_surat,' . $id,
        ]);

        $data = SuratMasuk::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('surat-masuk.index');
    }

    public function destroy($id)
    {
        SuratMasuk::destroy($id);
        return redirect()->route('surat-masuk.index');
    }
}
