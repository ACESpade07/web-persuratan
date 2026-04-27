@extends('layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Detail Surat Masuk</h2>

<div class="bg-white shadow rounded-lg p-6 space-y-4">

    <div>
        <label class="font-semibold">Nomor Surat:</label>
        <p>{{ $data->nomor_surat }}</p>
    </div>

    <div>
        <label class="font-semibold">Pengirim:</label>
        <p>{{ $data->pengirim }}</p>
    </div>

    <div>
        <label class="font-semibold">Tanggal Surat:</label>
        <p>{{ $data->tanggal_surat }}</p>
    </div>

    <div>
        <label class="font-semibold">Perihal:</label>
        <p>{{ $data->perihal }}</p>
    </div>

    <div>
        <label class="font-semibold">File:</label><br>

        @if($data->file)
            <a href="{{ asset('uploads/' . $data->file) }}" 
               target="_blank"
               class="text-blue-600 underline">
                Lihat File
            </a>
        @else
            <p class="text-gray-500">Tidak ada file</p>
        @endif
    </div>

    <div class="pt-4">
        <a href="{{ route('surat-masuk.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>

</div>

@endsection