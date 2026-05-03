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
        $nomorOtomatis = $this->generateNomorSurat();
        return view('surat_masuk.create', compact('nomorOtomatis'));
    }

    public function store(Request $request)
    {
        $file     = $request->file('file');
        $namaFile = null;

        if ($file) {
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);
        }

        SuratMasuk::create([
            'nomor_surat'   => $request->nomor_surat,
            'pengirim'      => $request->pengirim,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal'       => $request->perihal,
            'file'          => $namaFile,
        ]);

        return redirect()->route('surat-masuk.index');
    }

    public function show($id)
    {
        $data = SuratMasuk::findOrFail($id);
        return view('surat_masuk.show', compact('data'));
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

        // Jika ada file baru, hapus file lama lalu simpan yang baru
        if ($request->hasFile('file')) {
            if ($data->file) {
                $fileLama = public_path('uploads/' . $data->file);
                if (file_exists($fileLama)) {
                    unlink($fileLama);
                }
            }
            $namaFile = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads'), $namaFile);
            $data->file = $namaFile;
        }

        $data->pengirim      = $request->pengirim;
        $data->nomor_surat   = $request->nomor_surat;
        $data->tanggal_surat = $request->tanggal_surat;
        $data->perihal       = $request->perihal;
        $data->save();

        return redirect()->route('surat-masuk.index');
    }

    public function destroy($id)
    {
        $data = SuratMasuk::findOrFail($id);

        // Hapus file dari folder uploads jika ada
        if ($data->file) {
            $filePath = public_path('uploads/' . $data->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $data->delete();

        return redirect()->route('surat-masuk.index');
    }

    

    // ── Helper ────────────────────────────────────────────────
    private function generateNomorSurat(): string
    {
        $bulanRomawi = [
            1 => 'I',   2 => 'II',   3 => 'III', 4 => 'IV',
            5 => 'V',   6 => 'VI',   7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X',   11 => 'XI', 12 => 'XII',
        ];

        $bulan = (int) date('n');
        $tahun = date('Y');

        $count = SuratMasuk::whereYear('created_at', $tahun)
                            ->whereMonth('created_at', $bulan)
                            ->count();

        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        return $nomorUrut . '/IMIGRASI/' . $bulanRomawi[$bulan] . '/' . $tahun;
    }
}