@extends('layout')

@section('content')

<div class="max-w-2xl" style="padding: 1.5rem 0;">

    {{-- Header --}}
    <div class="flex items-start justify-between gap-4 flex-wrap mb-6">
        <div>
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-1">Surat Keluar</p>
            <h1 class="text-xl font-medium text-gray-900">Detail Surat</h1>
        </div>
        <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1.5 rounded-full
                     bg-blue-50 text-blue-600 border border-blue-100">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
            Keluar
        </span>
    </div>

    {{-- Card --}}
    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">

        <div class="flex items-center gap-2 px-5 py-3.5 bg-gray-50 border-b border-gray-100">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 14 14">
                <rect x="2" y="2" width="10" height="10" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                <path d="M4 5h6M4 7h6M4 9h3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
            <span class="text-xs font-medium text-gray-500">Informasi Surat</span>
        </div>

        <div class="divide-y divide-gray-50">

            {{-- Nomor Surat --}}
            <div class="flex gap-4 px-5 py-4 items-start">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider w-32 shrink-0 pt-0.5">
                    Nomor Surat
                </p>
                <p class="text-sm font-semibold text-blue-600 font-mono">
                    {{ $data->nomor_surat }}
                </p>
            </div>

            {{-- Tujuan --}}
            <div class="flex gap-4 px-5 py-4 items-start">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider w-32 shrink-0 pt-0.5">
                    Tujuan
                </p>
                <p class="text-sm text-gray-800">{{ $data->tujuan }}</p>
            </div>

            {{-- Tanggal --}}
            <div class="flex gap-4 px-5 py-4 items-start">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider w-32 shrink-0 pt-0.5">
                    Tanggal Surat
                </p>
                <p class="text-sm text-gray-800">
                    {{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d F Y') }}
                </p>
            </div>

            {{-- Perihal --}}
            <div class="flex gap-4 px-5 py-4 items-start">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider w-32 shrink-0 pt-0.5">
                    Perihal
                </p>
                <p class="text-sm text-gray-800 leading-relaxed">{{ $data->perihal }}</p>
            </div>

            {{-- File --}}
            <div class="flex gap-4 px-5 py-4 items-start">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider w-32 shrink-0 pt-0.5">
                    File
                </p>
                @if($data->file)
                    <a href="{{ asset('uploads/' . $data->file) }}"
                       target="_blank"
                       class="inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg
                              bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-100 transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 13 13">
                            <path d="M6.5 1v7.5M4 6.5l2.5 2.5 2.5-2.5"
                                  stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 10h9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                        </svg>
                        Unduh File
                    </a>
                @else
                    <p class="text-sm text-gray-400 italic">Tidak ada file</p>
                @endif
            </div>

        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex gap-2 flex-wrap mt-5">
        <a href="{{ route('surat-keluar.edit', $data->id) }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium px-4 py-2 rounded-lg
                  bg-amber-50 text-amber-600 border border-amber-100 hover:bg-amber-100 transition">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 13 13">
                <path d="M9 2l2 2-6 6H3V8l6-6z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
            </svg>
            Edit
        </a>
        <a href="{{ route('surat-keluar.index') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium px-4 py-2 rounded-lg
                  bg-gray-50 text-gray-500 border border-gray-200 hover:bg-gray-100 transition">
            ← Kembali
        </a>
    </div>

</div>

@endsection