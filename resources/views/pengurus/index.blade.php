@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-gray-50 py-1 md:py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">
            <span class="text-sm font-bold text-gray-500 tracking-widest uppercase mb-2 block">STRUKTUR</span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-pmii-blue uppercase leading-tight">
                PMII SIDOARJO PERIODE 2024-2026
            </h1>
            <span class="block w-24 h-1.5 bg-pmii-yellow mt-4 mx-auto md:mx-0 rounded-full"></span>
        </div>
    </div>

    <!-- Team Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($teams as $member)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 bg-white aspect-[3/4] cursor-pointer">
                <!-- Image -->
                <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=0D2E78&color=fff&size=400' }}"
                     alt="{{ $member->name }}"
                     class="w-full h-full object-cover object-top filter group-hover:grayscale-0 transition-all duration-500">
                
                <!-- Overlay Gradient (Usually hidden or subtle, appears on hover) -->
                <div class="absolute inset-0 bg-gradient-to-t from-pmii-blue/90 via-pmii-blue/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 translate-y-4 group-hover:translate-y-0 text-center">
                    
                    <!-- Content Slide Up -->
                    <div class="transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-100">
                        <div class="w-16 h-16 mx-auto bg-white/10 rounded-full flex items-center justify-center mb-4 backdrop-blur-md border border-white/20">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1 leading-tight">{{ $member->name }}</h3>
                        <p class="text-sm text-yellow-300 font-medium mb-4">{{ $member->position }}</p>
                        
                        <!-- Social Shortcuts -->
                        <div class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-700 delay-200">
                            @if($member->instagram)
                            <a href="https://instagram.com/{{ $member->instagram }}" target="_blank"
                               class="w-10 h-10 bg-white text-pmii-blue rounded-full flex items-center justify-center hover:bg-pmii-yellow hover:text-pmii-blue transition-colors shadow-lg">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Default Bottom Label (Visible when NOT hovered) -->
                <div class="absolute bottom-0 left-0 right-0 bg-white p-4 text-center transform group-hover:translate-y-full transition-transform duration-300 border-t border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $member->name }}</h3>
                    <p class="text-xs text-pmii-blue font-bold uppercase tracking-wider truncate">{{ $member->position }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20 text-gray-400">
                <i class="fas fa-users text-5xl mb-4"></i>
                <p class="text-lg">Data pengurus belum tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection
