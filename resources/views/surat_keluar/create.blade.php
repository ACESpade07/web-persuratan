@extends('layout')

@section('content')

<div class="max-w-2xl" style="padding: 1.5rem 0;">

    {{-- Header --}}
    <div class="mb-6">
        <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-1">Surat Keluar</p>
        <h1 class="text-xl font-medium text-gray-900">Tambah Surat Keluar</h1>
    </div>

    <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">

            <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 14 14">
                    <rect x="2" y="2" width="10" height="10" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                    <path d="M4 5h6M4 7h6M4 9h3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
                <span class="text-xs font-medium text-gray-500">Informasi Surat</span>
            </div>

            <div class="p-6 space-y-5">

                {{-- Tujuan --}}
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1.5">
                        Tujuan
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                             fill="none" viewBox="0 0 14 14">
                            <circle cx="7" cy="4.5" r="2.5" stroke="currentColor" stroke-width="1.2"/>
                            <path d="M2 11.5c0-2.5 2.2-4 5-4s5 1.5 5 4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                        <input type="text" name="tujuan" value="{{ old('tujuan') }}"
                               placeholder="Nama instansi atau penerima..."
                               class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm
                                      bg-gray-50 text-gray-800 placeholder-gray-400
                                      focus:outline-none focus:border-blue-300 focus:bg-white transition-colors">
                    </div>
                    @error('tujuan')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor Surat & Tanggal --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Nomor Surat (otomatis) --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1.5">
                            Nomor Surat
                            <span class="ml-1.5 text-[10px] normal-case tracking-normal
                                         bg-blue-50 text-blue-500 border border-blue-100
                                         px-1.5 py-0.5 rounded-full font-medium">
                                otomatis
                            </span>
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-300 pointer-events-none"
                                 fill="none" viewBox="0 0 14 14">
                                <rect x="2" y="2" width="10" height="10" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                                <path d="M5 5h4M5 7h2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                            <input type="text" name="nomor_surat"
                                   value="{{ old('nomor_surat', $nomorOtomatis) }}"
                                   readonly
                                   class="w-full pl-9 pr-3 py-2.5 border border-gray-100 rounded-lg text-sm font-mono
                                          bg-gray-50 text-gray-500 cursor-not-allowed select-none">
                        </div>
                        @error('nomor_surat')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1.5">
                            Tanggal Surat
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                                 fill="none" viewBox="0 0 14 14">
                                <rect x="2" y="3" width="10" height="9" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                                <path d="M5 2v2M9 2v2M2 6h10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                            <input type="date" name="tanggal_surat"
                                   value="{{ old('tanggal_surat', date('Y-m-d')) }}"
                                   class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm
                                          bg-gray-50 text-gray-800
                                          focus:outline-none focus:border-blue-300 focus:bg-white transition-colors">
                        </div>
                        @error('tanggal_surat')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Perihal --}}
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1.5">
                        Perihal
                    </label>
                    <input type="text" name="perihal" value="{{ old('perihal') }}"
                           placeholder="Isi perihal surat..."
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm
                                  bg-gray-50 text-gray-800 placeholder-gray-400
                                  focus:outline-none focus:border-blue-300 focus:bg-white transition-colors">
                    @error('perihal')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload File --}}
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1.5">
                        Upload File
                    </label>
                    <label for="file"
                           class="flex flex-col items-center justify-center gap-2 w-full
                                  border border-dashed border-gray-200 rounded-lg bg-gray-50
                                  py-8 cursor-pointer hover:border-blue-300 hover:bg-blue-50 transition-colors">
                        <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24">
                            <path d="M12 15V3M8 7l4-4 4 4" stroke="currentColor" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2" stroke="currentColor"
                                  stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <span id="fileName" class="text-sm text-gray-400">Klik atau seret file ke sini</span>
                        <span class="text-xs text-gray-300">PDF, DOC, DOCX hingga 10MB</span>
                        <input type="file" name="file" id="file" accept=".pdf,.doc,.docx" class="hidden"
                               onchange="document.getElementById('fileName').textContent =
                                         this.files[0]?.name ?? 'Klik atau seret file ke sini'">
                    </label>
                    @error('file')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-2 flex-wrap pt-1">
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 border border-blue-200
                                   px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 13 13">
                            <path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Simpan Surat
                    </button>
                    <a href="{{ route('surat-keluar.index') }}"
                       class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-500 border border-gray-200
                              px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                        ← Kembali
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>

@endsection