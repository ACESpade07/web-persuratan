@extends('layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <!-- Surat Masuk -->
    <div class="bg-green-500 text-white p-6 rounded-xl shadow">
        <h2 class="text-lg">Surat Masuk</h2>
        <p class="text-3xl font-bold mt-2">{{ $totalMasuk }}</p>
    </div>

    <!-- Surat Keluar -->
    <div class="bg-blue-500 text-white p-6 rounded-xl shadow">
        <h2 class="text-lg">Surat Keluar</h2>
        <p class="text-3xl font-bold mt-2">{{ $totalKeluar }}</p>
    </div>

    <!-- Total Surat -->
    <div class="bg-gray-700 text-white p-6 rounded-xl shadow">
        <h2 class="text-lg">Total Surat</h2>
        <p class="text-3xl font-bold mt-2">{{ $totalSemua }}</p>
    </div>

</div>

<!-- 🔷 CARD STATISTIK -->
<div class="grid grid-cols-3 gap-4 mb-6">
    <!-- isi card -->
</div>

<!-- 🔍 🔥 TARUH SEARCH DI SINI -->
<form method="GET" action="{{ url('/') }}" class="mb-4 flex gap-2">

    <input 
        type="text" 
        name="search" 
        value="{{ $search }}" 
        placeholder="Cari nomor / pengirim / perihal..."
        class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-300">

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cari
    </button>

    @if($search)
        <a href="{{ url('/') }}" 
           class="bg-gray-400 text-white px-4 py-2 rounded">
            Reset
        </a>
    @endif

</form>


<!-- 🔥 TARUH TABEL GABUNGAN DI SINI -->
<div class="bg-white shadow-xl rounded-2xl p-8 mt-6">

    <h2 class="text-2xl font-bold mb-6">Semua Surat</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full text-base border border-gray-200 rounded-lg overflow-hidden">

            <!-- HEADER -->
            <thead class="bg-blue-900 text-white">
                <tr class="text-lg">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nomor Surat</th>
                    <th class="px-6 py-4">Pengirim / Tujuan</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Jenis</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($dataGabungan as $item)
                <tr class="border-t text-center hover:bg-gray-100 transition">

                    <td class="px-6 py-4 font-medium">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-blue-700">
                        {{ $item->nomor_surat }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->kontak ?? $item->pengirim ?? $item->tujuan }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->tanggal_surat }}
                    </td>

                    <td class="px-6 py-4">
                        @if($item->jenis == 'Masuk')
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                Masuk
                            </span>
                        @else
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                                Keluar
                            </span>
                        @endif
                    </td>

                    <td>
                        @if($item->jenis == 'Masuk')
                            <a href="{{ route('surat-masuk.show', $item->id) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded">
                                Lihat
                            </a>
                        @else
                            <a href="{{ route('surat-keluar.show', $item->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded">
                                Lihat
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500 text-lg">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
    <div class="flex justify-between items-center mt-6">

        <!-- Previous -->
        @if($page > 1)
            <a href="?page={{ $page - 1 }}&search={{ $search }}" 
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Previous
            </a>
        @else
            <span></span>
        @endif

        <!-- Info -->
        <span class="text-gray-600 font-semibold">
            Halaman {{ $page }}
        </span>

        <!-- Next -->
        @if($page * $perPage < $total)
            <a href="?page={{ $page + 1 }}&search={{ $search }}" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Next →
            </a>
        @endif

</div>

</div>

@endsection