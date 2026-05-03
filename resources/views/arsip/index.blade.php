@extends('layout')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-medium text-gray-900">Arsip Surat</h1>
        <p class="text-sm text-gray-400 mt-0.5">Semua surat masuk dan keluar</p>
    </div>

    {{-- Tombol Export --}}
    <div class="flex gap-2 flex-wrap">
        <a href="{{ route('arsip.export-pdf', request()->query()) }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium px-3.5 py-2 rounded-lg
                  bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14">
                <rect x="2" y="1" width="10" height="12" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                <path d="M4 5h6M4 7h6M4 9h3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
            Export PDF
        </a>
        <a href="{{ route('arsip.export-excel', request()->query()) }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium px-3.5 py-2 rounded-lg
                  bg-emerald-50 text-emerald-600 border border-emerald-100 hover:bg-emerald-100 transition">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14">
                <rect x="2" y="1" width="10" height="12" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                <path d="M4 4l2 3-2 3M8 10h2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Export Excel
        </a>
    </div>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-5">
    <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-400 mb-1">Total Surat</p>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-gray-400"></span>
            <span class="text-2xl font-medium text-gray-900">{{ $data->count() }}</span>
        </div>
    </div>
    <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-400 mb-1">Surat Masuk</p>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="text-2xl font-medium text-gray-900">{{ $totalMasuk }}</span>
        </div>
    </div>
    <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-400 mb-1">Surat Keluar</p>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            <span class="text-2xl font-medium text-gray-900">{{ $totalKeluar }}</span>
        </div>
    </div>
</div>

{{-- Filter --}}
<form method="GET" action="{{ route('arsip.index') }}"
      class="flex flex-wrap gap-2 mb-5">

    {{-- Search --}}
    <input type="text" name="search" value="{{ $search }}"
           placeholder="Cari nomor / pengirim / perihal..."
           class="flex-1 min-w-[200px] border border-gray-200 rounded-lg px-4 py-2 text-sm
                  focus:outline-none focus:ring-2 focus:ring-blue-200">

    {{-- Filter Tahun --}}
    <select name="tahun"
            class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600
                   focus:outline-none focus:ring-2 focus:ring-blue-200">
        <option value="">Semua Tahun</option>
        @foreach($tahunList as $t)
            <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
        @endforeach
    </select>

    {{-- Filter Bulan --}}
    <select name="bulan"
            class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600
                   focus:outline-none focus:ring-2 focus:ring-blue-200">
        <option value="">Semua Bulan</option>
        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $namaBulan)
            <option value="{{ $i + 1 }}" {{ $bulan == $i + 1 ? 'selected' : '' }}>
                {{ $namaBulan }}
            </option>
        @endforeach
    </select>

    {{-- Filter Jenis --}}
    <select name="jenis"
            class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600
                   focus:outline-none focus:ring-2 focus:ring-blue-200">
        <option value="">Semua Jenis</option>
        <option value="Masuk"  {{ $jenis == 'Masuk'  ? 'selected' : '' }}>Masuk</option>
        <option value="Keluar" {{ $jenis == 'Keluar' ? 'selected' : '' }}>Keluar</option>
    </select>

    <button type="submit"
            class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        Filter
    </button>

    @if($search || $tahun || $bulan || $jenis)
        <a href="{{ route('arsip.index') }}"
           class="px-4 py-2 text-sm border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50 transition">
            Reset
        </a>
    @endif

</form>

{{-- Tabel --}}
<div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm" style="table-layout: fixed;">
            <colgroup>
                <col style="width: 45px;">
                <col style="width: 155px;">
                <col style="width: 85px;">
                <col>
                <col>
                <col style="width: 105px;">
                <col style="width: 80px;">  {{-- file --}}
                <col style="width: 70px;">  {{-- aksi dihapus, ganti jadi file --}}
            </colgroup>

            <thead class="bg-gray-50 text-gray-400 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-center font-medium">No</th>
                    <th class="px-4 py-3 text-left font-medium">Nomor Surat</th>
                    <th class="px-4 py-3 text-center font-medium">Jenis</th>
                    <th class="px-4 py-3 text-left font-medium">Pengirim / Tujuan</th>
                    <th class="px-4 py-3 text-left font-medium">Perihal</th>
                    <th class="px-4 py-3 text-left font-medium">Tanggal</th>
                    <th class="px-4 py-3 text-center font-medium">Aksi</th>
                    <th class="px-4 py-3 text-center font-medium">File</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse($data as $item)
                <tr class="hover:bg-gray-50 transition-colors">

                    <td class="px-4 py-3 text-center text-xs text-gray-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-medium text-blue-600 truncate font-mono text-xs">
                        {{ $item->nomor_surat }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        @if($item->jenis == 'Masuk')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs
                                         font-medium bg-emerald-50 text-emerald-700">
                                Masuk
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs
                                         font-medium bg-blue-50 text-blue-700">
                                Keluar
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-gray-700 truncate">{{ $item->kontak }}</td>

                    <td class="px-4 py-3 text-gray-500 truncate text-xs">{{ $item->perihal }}</td>

                    <td class="px-4 py-3 text-gray-400 text-xs">
                        {{ \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d M Y') }}
                    </td>

                    {{-- Kolom File (ganti dari route_show) --}}
                    <td class="px-4 py-3 text-center">
                        @if($item->file)
                            <a href="{{ asset('uploads/' . $item->file) }}" target="_blank"
                            class="text-xs font-medium px-2.5 py-1.5 rounded-md
                                    bg-blue-50 text-blue-600 border border-blue-100
                                    hover:bg-blue-100 transition">
                                Lihat
                            </a>
                        @else
                            <span class="text-xs text-gray-300">—</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-12 text-gray-400 text-sm">
                        Tidak ada data untuk filter yang dipilih
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 border-t border-gray-50">
        <p class="text-xs text-gray-300">Menampilkan {{ $data->count() }} surat</p>
    </div>
</div>

@endsection