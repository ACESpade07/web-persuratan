@extends('layout')

@section('content')

<div style="padding: 1.5rem 0;">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-medium text-gray-900">Dashboard</h1>
        <span class="text-sm text-gray-500">Sistem Manajemen Surat</span>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">

        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500 mb-1">Surat Masuk</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-2xl font-medium text-gray-900">{{ $totalMasuk }}</span>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500 mb-1">Surat Keluar</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span class="text-2xl font-medium text-gray-900">{{ $totalKeluar }}</span>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500 mb-1">Total Surat</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                <span class="text-2xl font-medium text-gray-900">{{ $totalSemua }}</span>
            </div>
        </div>

    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ url('/') }}" class="flex flex-wrap gap-2 mb-5">
        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nomor / pengirim / perihal..."
            class="flex-1 min-w-[200px] border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">

        <button type="submit"
            class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Cari
        </button>

        @if($search)
            <a href="{{ url('/') }}"
               class="px-4 py-2 text-sm border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50 transition">
                Reset
            </a>
        @endif
    </form>

    {{-- Tabel --}}
    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">

        <div class="px-5 py-4 border-b border-gray-100">
            <p class="text-base font-medium text-gray-900">Semua Surat</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm" style="table-layout: fixed;">
                <colgroup>
                    <col style="width: 50px;">
                    <col style="width: 150px;">
                    <col>
                    <col style="width: 120px;">
                    <col style="width: 100px;">
                    <col style="width: 90px;">
                </colgroup>

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-5 py-3 text-center font-medium">No</th>
                        <th class="px-5 py-3 text-left font-medium">Nomor Surat</th>
                        <th class="px-5 py-3 text-left font-medium">Pengirim / Tujuan</th>
                        <th class="px-5 py-3 text-left font-medium">Tanggal</th>
                        <th class="px-5 py-3 text-center font-medium">Jenis</th>
                        <th class="px-5 py-3 text-center font-medium">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @forelse($dataGabungan as $item)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <td class="px-5 py-3 text-center text-gray-400 text-xs">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-5 py-3 font-medium text-blue-600 truncate">
                            {{ $item->nomor_surat }}
                        </td>

                        <td class="px-5 py-3 text-gray-700 truncate">
                            {{ $item->kontak ?? $item->pengirim ?? $item->tujuan }}
                        </td>

                        <td class="px-5 py-3 text-gray-500 text-xs">
                            {{ $item->tanggal_surat }}
                        </td>

                        <td class="px-5 py-3 text-center">
                            @if($item->jenis == 'Masuk')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    Keluar
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-3 text-center">
                            @if($item->jenis == 'Masuk')
                                <a href="{{ route('surat-masuk.show', $item->id) }}"
                                   class="text-xs font-medium text-emerald-600 hover:underline">
                                    Lihat
                                </a>
                            @else
                                <a href="{{ route('surat-keluar.show', $item->id) }}"
                                   class="text-xs font-medium text-blue-600 hover:underline">
                                    Lihat
                                </a>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400 text-sm">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">

            @if($page > 1)
                <a href="?page={{ $page - 1 }}&search={{ $search }}"
                   class="text-sm text-gray-600 border border-gray-200 px-3 py-1.5 rounded-lg hover:bg-gray-50 transition">
                    ← Previous
                </a>
            @else
                <span></span>
            @endif

            <span class="text-sm text-gray-500">Halaman {{ $page }}</span>

            @if($page * $perPage < $total)
                <a href="?page={{ $page + 1 }}&search={{ $search }}"
                   class="text-sm text-blue-600 border border-blue-200 px-3 py-1.5 rounded-lg hover:bg-blue-50 transition">
                    Next →
                </a>
            @endif

        </div>

    </div>

</div>

@endsection