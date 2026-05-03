<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data = SuratKeluar::all();
        return view('surat_keluar.index', compact('data'));
    }

    public function create()
    {
        $nomorOtomatis = $this->generateNomorSurat(); // ← tambahan
        return view('surat_keluar.create', compact('nomorOtomatis'));
    }

    public function store(Request $request)
    {
        $file     = $request->file('file');
        $namaFile = null;

        if ($file) {
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);
        }

        SuratKeluar::create([
            'nomor_surat'   => $request->nomor_surat, // ← ambil dari form
            'tujuan'        => $request->tujuan,       // ← sesuaikan: tujuan, bukan pengirim
            'tanggal_surat' => $request->tanggal_surat,
            'perihal'       => $request->perihal,
            'file'          => $namaFile,
        ]);

        return redirect()->route('surat-keluar.index');
    }

    public function show($id)
    {
        $data = SuratKeluar::findOrFail($id);
        return view('surat_keluar.show', compact('data'));
    }

    public function edit($id)
    {
        $data = SuratKeluar::findOrFail($id);
        return view('surat_keluar.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_keluar,nomor_surat,' . $id,
        ]);

        $data = SuratKeluar::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('surat-keluar.index');
    }

    public function destroy($id)
    {
        SuratKeluar::destroy($id);
        return redirect()->route('surat-keluar.index');
    }

    // ── Helper ────────────────────────────────────────────────
    private function generateNomorSurat(): string
    {
        $bulanRomawi = [
            1  => 'I',   2  => 'II',   3  => 'III', 4  => 'IV',
            5  => 'V',   6  => 'VI',   7  => 'VII', 8  => 'VIII',
            9  => 'IX',  10 => 'X',    11 => 'XI',  12 => 'XII',
        ];

        $bulan = (int) date('n');
        $tahun = date('Y');

        $count = SuratKeluar::whereYear('created_at', $tahun)
                             ->whereMonth('created_at', $bulan)
                             ->count();

        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        return $nomorUrut . '/SK/' . $bulanRomawi[$bulan] . '/' . $tahun; // ← SK
    }
}