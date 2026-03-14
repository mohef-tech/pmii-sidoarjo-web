@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-gray-50 py-1 md:py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <span class="text-sm font-bold text-gray-500 tracking-widest uppercase mb-2 block">RESOURCES</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-pmii-blue uppercase leading-tight">
                    FILE DOWNLOAD
                </h1>
                <span class="block w-24 h-1.5 bg-pmii-yellow mt-4 mx-auto md:mx-0 rounded-full"></span>
            </div>
            <p class="text-gray-500 max-w-md text-center md:text-right text-sm">
                Akses dan unduh berbagai dokumen resmi, materi kaderisasi, dan atribut organisasi PMII berkualitas tinggi.
            </p>
        </div>
    </div>

    <!-- Downloads Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-24 space-y-16">
        
        @forelse($downloads as $category => $items)
        <div class="relative">
            <!-- Category Title -->
            <div data-aos="fade-right" class="flex items-center gap-4 mb-8">
                <div class="bg-pmii-blue text-white p-3 rounded-xl shadow-md">
                     @if($category == 'Produk Hukum')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                     @elseif($category == 'Materi Kaderisasi')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                     @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 3-2 3 2zm0 0v-8"></path></svg>
                     @endif
                </div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $category }}</h2>
                <div class="h-px bg-gray-200 flex-1 ml-4"></div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all duration-300 group flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-blue-50 transition-colors">
                            @if($item->type == 'PDF')
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            @elseif($item->type == 'Word')
                            <i class="fas fa-file-word text-blue-500 text-2xl"></i>
                            @elseif($item->type == 'MP3')
                            <i class="fas fa-music text-purple-500 text-2xl"></i>
                            @elseif($item->type == 'PNG' || $item->type == 'JPG')
                             <i class="fas fa-image text-green-500 text-2xl"></i>
                            @else
                            <i class="fas fa-file text-gray-400 text-2xl"></i>
                            @endif
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded bg-gray-100 text-gray-500">{{ $item->type }}</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-pmii-blue transition-colors">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-500 mb-6">{{ $item->created_at->format('d M Y') }}</p>
                    
                    <a href="{{ asset('storage/' . $item->file) }}" download="{{ $item->title }}.{{ pathinfo($item->file, PATHINFO_EXTENSION) }}"
                       class="w-full mt-auto py-2.5 px-4 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-pmii-blue hover:text-white hover:border-pmii-blue transition-all flex items-center justify-center gap-2 group/btn">
                        <svg class="w-4 h-4 group-hover/btn:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @empty
            <div class="text-center py-20 text-gray-400">
                <i class="fas fa-folder-open text-5xl mb-4"></i>
                <p class="text-lg">Belum ada file yang tersedia.</p>
            </div>
        @endforelse

    </div>
@endsection
