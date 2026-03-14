@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-gray-50 py-1">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Permohonan SK Pengurus Komisariat</h1>
             <p class="text-gray-500 text-sm max-w-2xl mx-auto">
                Lengkapi formulir di bawah ini untuk mengajukan Surat Keputusan (SK) Pengurus Komisariat. Pastikan semua berkas yang diupload dalam format PDF/JPG.
            </p>
            <div class="w-20 h-1 bg-pmii-blue mx-auto mt-6 rounded-full"></div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-24">

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 flex items-start gap-3">
                <span class="text-2xl">✅</span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Tampilkan error validasi --}}
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                <p class="font-bold mb-2">Terdapat kesalahan:</p>
                <ul class="list-disc ml-4 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div data-aos="zoom-in-up" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
            
            <form action="{{ route('sk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Personal Info Section -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Pemohon <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}" class="w-full rounded-lg border-gray-300 focus:border-pmii-blue focus:ring focus:ring-pmii-blue/20 transition-shadow py-3 px-4 bg-gray-50 focus:bg-white" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="w-full rounded-lg border-gray-300 focus:border-pmii-blue focus:ring focus:ring-pmii-blue/20 transition-shadow py-3 px-4 bg-gray-50 focus:bg-white" placeholder="Contoh: 081234567890" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Asal Komisariat <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($komisariat as $kom)
                            <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-blue-50 hover:border-pmii-blue transition-colors group">
                                <input type="radio" name="komisariat" value="{{ $kom }}"
                                       {{ old('komisariat') == $kom ? 'checked' : '' }}
                                       class="form-radio text-pmii-blue focus:ring-pmii-blue">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-pmii-blue">{{ $kom }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 my-8">

                 <!-- File Uploads Section -->
                 <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-pmii-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Berkas Persyaratan
                    </h3>
                    
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($berkas as $item)
                        @php
                            $name = $item['key'];
                            $label = $item['label'];
                            $isRequired = $item['is_required'] ?? false;
                        @endphp
                        <div class="upload-wrapper relative group" id="wrap_{{ $name }}">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 group-hover:text-pmii-blue transition-colors">
                                {{ $label }} 
                                @if($isRequired)
                                    <span class="text-red-500">*</span>
                                @else
                                    <span class="text-red-400 text-xs normal-case font-normal">(opsional)</span>
                                @endif
                            </label>

                            {{-- Area Upload — state: kosong --}}
                            <label id="box_{{ $name }}"
                                   class="upload-box flex flex-col items-center justify-center w-full h-28 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-pmii-blue transition-all">

                                {{-- Ikon + teks default (tersembunyi setelah file dipilih) --}}
                                <div id="empty_{{ $name }}" class="flex flex-col items-center justify-center">
                                    <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="text-xs text-gray-500 font-medium">Klik untuk upload file</p>
                                    <p class="text-[10px] text-gray-400 mt-1">PDF, JPG, PNG (Maks 10MB)</p>
                                </div>

                                {{-- Info file setelah dipilih (tersembunyi saat kosong) --}}
                                <div id="filled_{{ $name }}" class="hidden flex-col items-center justify-center gap-1 px-4 text-center">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mb-1">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p id="fname_{{ $name }}" class="text-xs font-bold text-green-700 truncate max-w-[240px]"></p>
                                    <p id="fsize_{{ $name }}" class="text-[10px] text-green-500"></p>
                                    <p class="text-[10px] text-gray-400 mt-1">Klik untuk ganti file</p>
                                </div>

                                <input type="file" name="{{ $name }}" id="{{ $name }}"
                                       class="hidden"
                                       onchange="handleFileChange(this, '{{ $name }}')" />
                            </label>
                        </div>
                        @endforeach
                    </div>
                 </div>

                 {{-- JavaScript visual feedback upload --}}
                 <script>
                 function handleFileChange(input, name) {
                     const file = input.files[0];
                     const box   = document.getElementById('box_'   + name);
                     const empty = document.getElementById('empty_' + name);
                     const filled= document.getElementById('filled_'+ name);
                     const fname = document.getElementById('fname_' + name);
                     const fsize = document.getElementById('fsize_' + name);

                     if (file) {
                         // Ubah tampilan kotak → hijau
                         box.classList.remove('border-gray-300','bg-gray-50','hover:bg-blue-50','hover:border-pmii-blue','border-dashed');
                         box.classList.add('border-green-400','bg-green-50','border-solid');

                         // Tampilkan info file
                         empty.classList.add('hidden');
                         filled.classList.remove('hidden');
                         filled.classList.add('flex');
                         fname.textContent = file.name;
                         const kb = file.size / 1024;
                         fsize.textContent = kb > 1024
                             ? (kb / 1024).toFixed(2) + ' MB'
                             : kb.toFixed(0) + ' KB';
                     }
                 }
                 </script>

                 <div class="pt-6">
                     <button type="submit" class="w-full bg-pmii-blue text-white font-bold py-4 rounded-xl shadow-lg hover:bg-blue-900 hover:shadow-xl transition-all transform hover:scale-[1.01] flex items-center justify-center gap-2">
                         <i class="fas fa-paper-plane"></i> Kirim Permohonan
                     </button>
                 </div>
            </form>
        </div>
    </div>
@endsection
