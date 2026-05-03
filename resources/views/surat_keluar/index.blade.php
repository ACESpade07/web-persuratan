@extends('layout')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-medium text-gray-900">Surat Keluar</h1>
        <p class="text-sm text-gray-400 mt-0.5">{{ count($data) }} surat ditemukan</p>
    </div>
    <a href="{{ route('surat-keluar.create') }}"
       class="inline-flex items-center gap-1.5 text-sm font-medium px-3.5 py-2 rounded-lg
              bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-100 transition">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.8">
            <path d="M7 2v10M2 7h10" stroke-linecap="round"/>
        </svg>
        Tambah Surat
    </a>
</div>

{{-- Tabel --}}
<div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm" style="table-layout: fixed;">
            <colgroup>
                <col style="width: 50px;">
                <col style="width: 150px;">
                <col>
                <col style="width: 120px;">
                <col style="width: 170px;">
            </colgroup>

            <thead class="bg-gray-50 text-gray-400 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-center font-medium">No</th>
                    <th class="px-4 py-3 text-left font-medium">Nomor Surat</th>
                    <th class="px-4 py-3 text-left font-medium">Tujuan</th>
                    <th class="px-4 py-3 text-left font-medium">Tanggal</th>
                    <th class="px-4 py-3 text-center font-medium">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse($data as $item)
                <tr class="hover:bg-gray-50 transition-colors">

                    <td class="px-4 py-3 text-center text-xs text-gray-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-medium text-blue-600 truncate">
                        {{ $item->nomor_surat }}
                    </td>

                    <td class="px-4 py-3 text-gray-700 truncate">
                        {{ $item->tujuan }}
                    </td>

                    <td class="px-4 py-3 text-gray-400 text-xs">
                        {{ $item->tanggal_surat }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-1.5">

                            {{-- Lihat --}}
                            <a href="{{ route('surat-keluar.show', $item->id) }}"
                               class="text-xs font-medium px-2.5 py-1.5 rounded-md
                                      bg-blue-50 text-blue-600 border border-blue-100
                                      hover:bg-blue-100 transition">
                                Lihat
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('surat-keluar.edit', $item->id) }}"
                               class="text-xs font-medium px-2.5 py-1.5 rounded-md
                                      bg-amber-50 text-amber-600 border border-amber-100
                                      hover:bg-amber-100 transition">
                                Edit
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('surat-keluar.destroy', $item->id) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs font-medium px-2.5 py-1.5 rounded-md
                                               bg-red-50 text-red-500 border border-red-100
                                               hover:bg-red-100 transition cursor-pointer">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12 text-gray-400 text-sm">
                        Belum ada data surat keluar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 border-t border-gray-50">
        <p class="text-xs text-gray-300">Menampilkan {{ count($data) }} surat</p>
    </div>

</div>

@endsection