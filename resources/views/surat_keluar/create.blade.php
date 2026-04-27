@extends('layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Tambah Surat Keluar</h2>

<form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <!-- <div>
        <label class="block mb-1 font-semibold">Nomor Surat</label>
        <input type="text" name="nomor_surat" 
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
    </div> -->

    <div>
        <label class="block mb-1 font-semibold">Pengirim</label>
        <input type="text" name="pengirim" 
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Tanggal Surat</label>
        <input type="date" name="tanggal_surat" 
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Perihal</label>
        <input type="text" name="perihal" 
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Upload File</label>
        <input type="file" name="file" 
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="flex space-x-2">
        <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>

        <a href="{{ route('surat-keluar.index') }}" 
           class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Kembali
        </a>
    </div>

</form>

@endsection