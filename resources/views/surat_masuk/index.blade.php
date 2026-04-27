@extends('layout')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Surat Masuk</h2>
    <a href="{{ route('surat-masuk.create') }}" 
       class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        + Tambah
    </a>
</div>

<div class="overflow-x-auto">
<table class="min-w-full bg-white border border-gray-200">
    <thead class="bg-blue-900 text-white">
        <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nomor</th>
            <th class="px-4 py-2">Pengirim</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr class="text-center border-t hover:bg-gray-100">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $item->nomor_surat }}</td>
            <td class="px-4 py-2">{{ $item->pengirim }}</td>
            <td class="px-4 py-2">{{ $item->tanggal_surat }}</td>
            <td class="px-4 py-2 space-x-2">

                <a href="{{ route('surat-masuk.show', $item->id) }}" 
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Lihat
                </a>

                <a href="{{ route('surat-masuk.edit', $item->id) }}" 
                   class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500">
                    Edit
                </a>

                <form action="{{ route('surat-masuk.destroy', $item->id) }}" 
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection