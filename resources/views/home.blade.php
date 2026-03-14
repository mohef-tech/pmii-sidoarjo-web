@extends('layouts.app')

@section('content')
    <!-- Hero Section — Dynamic Slider -->
    @php
        $hasSliders       = isset($sliders) && $sliders->count() > 0;
        $linkBergabung    = \App\Models\SiteSetting::get('link_bergabung', '#');
        $linkStats        = \App\Models\SiteSetting::get('link_stats_spreadsheet', '');
    @endphp

    {{-- ============================
         HERO SECTION
         Foto dikelola di Admin → Hero Slider
         Teks statis — ubah langsung di sini
    ============================ --}}
    @if($hasSliders)
    <section id="hero" class="relative overflow-hidden" style="height:100vh;min-height:600px;"
        x-data="{
            current: 0,
            total: {{ $sliders->count() }},
            progress: 0,
            timer: null,
            interval: 6000,
            init() { this.startTimer(); },
            startTimer() {
                clearInterval(this.timer);
                this.progress = 0;
                this.timer = setInterval(() => {
                    this.progress += (100 / (this.interval / 100));
                    if (this.progress >= 100) { this.next(); }
                }, 100);
            },
            next() { this.current = (this.current + 1) % this.total; this.startTimer(); },
            prev() { this.current = (this.current - 1 + this.total) % this.total; this.startTimer(); },
            goto(i) { this.current = i; this.startTimer(); }
        }"
        x-init="init()">

        {{-- ===================================================
             BACKGROUND FOTO SAJA — crossfade antar foto
             Teks/konten ada di layer z-30 di bawah (statis)
        =================================================== --}}
        @foreach($sliders as $index => $slider)
        @php $imgUrl = $slider->image ? asset('storage/' . $slider->image) : null; @endphp
        <div class="absolute inset-0" style="transition:opacity 1.5s ease-in-out;"
             :style="current === {{ $index }} ? 'opacity:1;z-index:1;' : 'opacity:0;z-index:0;'">
            {{-- Foto background — inline CSS agar cover/no-repeat 100% reliable --}}
            <div class="absolute inset-0"
                 style="background-image:url('{{ $imgUrl ?? '' }}');
                        background-size:cover;
                        background-repeat:no-repeat;
                        background-position:center center;
                        background-color:#0d1f5c;"></div>
            {{-- Overlay gradasi biru — ala nasdemsidoarjo --}}
            <div class="absolute inset-0" style="background:linear-gradient(105deg,rgba(10,25,80,0.88) 0%,rgba(10,25,80,0.65) 45%,rgba(10,25,80,0.30) 100%);"></div>
            <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(10,25,80,0.80) 0%,transparent 50%);"></div>
        </div>
        @endforeach

        {{-- ===================================================
             KONTEN STATIS — badge, judul, deskripsi, tombol
             Edit teks langsung di sini (tidak berubah saat slide ganti)
        =================================================== --}}
        <div class="absolute inset-0 flex flex-col justify-center" style="z-index:30;padding-bottom:90px;padding-top:80px;">
            <div class="max-w-7xl mx-auto w-full" style="padding:0 2rem;">
                <div class="max-w-2xl">

                    {{-- Badge kecil di atas --}}
                    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,193,7,0.15);border:1px solid rgba(255,193,7,0.45);color:#FFC107;font-size:11px;font-weight:700;padding:5px 14px;border-radius:999px;margin-bottom:22px;letter-spacing:1.5px;text-transform:uppercase;">
                        <span style="width:6px;height:6px;border-radius:50%;background:#FFC107;display:inline-block;"></span>
                        Periode Kepengurusan 2024–2027
                    </div>

                    {{-- Judul 3 baris besar --}}
                    <h1 style="font-size:clamp(2.2rem,5.5vw,4rem);font-weight:900;line-height:1.1;color:white;margin:0 0 20px;letter-spacing:-0.5px;">
                        PC PMII
                        <br><span style="color:#FFC107;">KABUPATEN</span>
                        <br>SIDOARJO
                    </h1>

                    {{-- Garis aksen kuning --}}
                    <div style="width:52px;height:4px;background:#FFC107;border-radius:4px;margin-bottom:20px;"></div>

                    {{-- Deskripsi singkat --}}
                    <p style="font-size:1rem;color:rgba(255,255,255,0.80);line-height:1.7;margin-bottom:32px;max-width:480px;">
                        Membangun kader yang progresif, kritis, dan berintegritas melalui
                        <span style="color:#FFC107;font-weight:600;">pendidikan</span> dan
                        <span style="color:#FFC107;font-weight:600;">gerakan kebangsaan</span>.
                    </p>

                    {{-- Tombol CTA --}}
                    <div style="display:flex;gap:14px;flex-wrap:wrap;align-items:center;">
                        <a href="{{ $linkBergabung ?: '#' }}" target="_blank"
                           style="background:#FFC107;color:#0d1f5c;font-weight:700;padding:13px 30px;border-radius:8px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;font-size:0.95rem;box-shadow:0 4px 20px rgba(255,193,7,0.35);transition:all 0.25s;"
                           onmouseover="this.style.background='#ffd335';this.style.transform='translateY(-1px)'" onmouseout="this.style.background='#FFC107';this.style.transform='none'">
                            Bergabung dengan Kami
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <!-- <a href="{{ route('articles.index') }}"
                           style="border:2px solid rgba(255,255,255,0.35);color:white;font-weight:600;padding:12px 26px;border-radius:8px;text-decoration:none;font-size:0.95rem;transition:all 0.25s;backdrop-filter:blur(4px);"
                           onmouseover="this.style.borderColor='rgba(255,255,255,0.7)';this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.35)';this.style.background='transparent'">
                            Lihat Program Kerja
                        </a> -->
                    </div>
                </div>
            </div>
        </div>

        {{-- Dots navigasi — pojok kanan bawah --}}
        <div class="absolute" style="bottom:22px;right:2rem;z-index:40;display:flex;gap:8px;align-items:center;">
            @foreach($sliders as $idx => $s)
            <button @click="goto({{ $idx }})"
                    class="rounded-full transition-all duration-500"
                    :class="current === {{ $idx }} ? 'bg-[#FFC107]' : 'bg-white/40 hover:bg-white/70'"
                    :style="current === {{ $idx }} ? 'width:26px;height:7px;' : 'width:7px;height:7px;'">
            </button>
            @endforeach
        </div>

        {{-- Progress bar bawah --}}
        <div class="absolute bottom-0 left-0 right-0" style="z-index:40;height:3px;background:rgba(255,255,255,0.12);">
            <div style="background:#FFC107;height:100%;transition:none;" :style="'width:'+progress+'%'"></div>
        </div>

    </section>

    @else
    {{-- =====================================================================
         FALLBACK HERO STATIS (jika belum ada slider di DB)
         Setelah upload slider di admin, bagian ini otomatis terganti.
    ====================================================================== --}}
    <section id="hero" class="relative min-h-[100vh] flex items-center bg-pmii-blue pt-3 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-[80%] h-full bg-blue-900/50 transform skew-x-12 translate-x-1/4 z-0"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full h-full flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2 text-left mb-12 md:mb-0 pt-10 md:pt-0">
                <h1 class="text-5xl md:text-6xl font-bold text-white leading-[1.15] mb-6">
                    Upgrade Your <br>
                    Knowledge and Skills <br>
                    with <span class="relative inline-block pb-2">
                        PMII
                        <span class="absolute bottom-0 left-0 w-full h-1.5 bg-pmii-yellow rounded-full"></span>
                    </span>
                </h1>
                <p class="text-xl text-gray-200 mb-10 font-normal">We are Indonesian Moslem Student Movement</p>
                <a href="#profil" class="bg-pmii-yellow hover:bg-yellow-500 text-pmii-blue px-10 py-4 rounded-full font-bold text-lg transition-all transform hover:scale-105 shadow-xl inline-flex items-center justify-center">
                    Selengkapnya
                </a>
            </div>
            <div class="w-full md:w-1/2 relative h-[600px] flex items-center justify-center">
                <div class="absolute right-[20%] top-[10%] w-[280px] h-[520px] bg-white rounded-[2.5rem] shadow-2xl p-4 transform scale-90 opacity-90 z-10 border-4 border-gray-100">
                     <div class="w-full h-full bg-blue-50 rounded-[2rem] flex flex-col items-center pt-8 overflow-hidden">
                         <div class="w-24 h-24 rounded-full bg-yellow-100 mb-2 overflow-hidden border-2 border-pmii-yellow p-1">
                             <img src="https://ui-avatars.com/api/?name=Sahabati+PMII&background=random&color=fff" class="w-full h-full rounded-full object-cover">
                         </div>
                         <h3 class="font-bold text-pmii-blue text-lg">Sahabati PMII</h3>
                         <div class="mt-auto w-full h-32 bg-blue-600 rounded-t-[50%] scale-150 translate-y-10"></div>
                     </div>
                </div>
                <div class="absolute right-[5%] top-[15%] w-[280px] h-[520px] bg-white rounded-[2.5rem] shadow-2xl p-4 z-20 border-4 border-white">
                    <div class="w-full h-full bg-white rounded-[2rem] flex flex-col items-center pt-8 shadow-inner overflow-hidden relative">
                         <div class="w-32 h-32 rounded-full bg-blue-100 mb-4 overflow-hidden border-4 border-blue-600 relative z-10">
                              <img src="https://ui-avatars.com/api/?name=Sahabat+PMII&background=0D8ABC&color=fff" class="w-full h-full object-cover">
                         </div>
                         <h3 class="font-bold text-pmii-blue text-xl mb-1">Sahabat PMII</h3>
                         <p class="text-[10px] text-gray-400 text-center px-6 leading-tight mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                         <button class="bg-blue-600 text-white text-sm font-bold px-8 py-2.5 rounded-full shadow-lg hover:bg-blue-700 transition">Let's Join</button>
                         <div class="absolute bottom-0 w-full">
                            <svg viewBox="0 0 1440 320" class="w-full h-24" preserveAspectRatio="none">
                                <path fill="#0a1e5e" fill-opacity="0.1" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                            </svg>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="absolute bottom-0 left-0 w-full leading-none z-20 overflow-hidden">
            <svg class="relative block w-[200%] -ml-[50%] h-8 md:h-14 lg:h-20 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="#ffffff" opacity=".25" class="wave-anim-1"></path>
                <path d="M0,0V15.81C13,36.92,46,62.34,98.58,68.55c53.24,6.3,101.9,1.62,135.93-8,68.85-19.46,134.42-70.37,196.22-68.49,60.84,1.85,108.56,60.54,166.42,75.31,58.33,14.9,118.82-3.14,179.28-21.19,69.87-20.89,149.69-32.93,223.6-7.85V0Z" fill="#ffffff" opacity=".5" class="wave-anim-2"></path>
            </svg>
             <style>
                .wave-anim-1 { animation: wave 10s ease-in-out infinite; transform-origin: center bottom; }
                .wave-anim-2 { animation: wave 7s ease-in-out infinite; transform-origin: center bottom; }
                @keyframes wave {
                    0% { transform: translateX(0) scaleY(1); }
                    50% { transform: translateX(-5%) scaleY(0.95); }
                    100% { transform: translateX(0) scaleY(1); }
                }
            </style>
        </div> -->
    </section>
    @endif

    <!-- About Section -->
    <section id="profil" class="py-20 bg-white scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-16">

                {{-- ── KIRI: Foto atau Video (dari SiteSetting) ────────────────────── --}}
                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        @if($profil['media_type'] === 'video' && $profil['media'])
                            {{-- Video embed (YouTube/Vimeo paste URL embed-nya di admin) --}}
                            <div class="aspect-w-4 aspect-h-3">
                                <iframe src="{{ $profil['media'] }}"
                                        class="w-full h-full rounded-2xl"
                                        style="min-height:320px;"
                                        allowfullscreen
                                        frameborder="0">
                                </iframe>
                            </div>
                        @elseif($profil['media'])
                            {{-- Foto dari storage --}}
                            <img src="{{ asset('storage/' . $profil['media']) }}"
                                 alt="{{ $profil['judul'] }}"
                                 class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-pmii-blue/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        @else
                            {{-- Fallback: foto default Unsplash --}}
                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                                 alt="About PMII"
                                 class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-pmii-blue/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        @endif
                    </div>
                </div>

                {{-- ── KANAN: Teks (dari SiteSetting) ──────────────────────────────── --}}
                <div class="w-full md:w-1/2 space-y-8" data-aos="fade-left">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-pmii-blue mb-6">
                            {{ $profil['judul'] }}
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed text-justify">
                            {{ $profil['deskripsi'] }}
                        </p>
                    </div>

                    <div class="space-y-8">
                        {{-- Item 1: Tujuan --}}
                        <div class="flex items-start gap-6 group">
                            <div class="flex-shrink-0 w-20 h-20 rounded-full border-2 border-pmii-blue flex items-center justify-center text-pmii-blue group-hover:bg-pmii-blue group-hover:text-white transition-all duration-300 shadow-lg">
                                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pmii-blue transition-colors">Tujuan PMII</h3>
                                <p class="text-gray-600 leading-relaxed text-sm">{{ $profil['tujuan'] }}</p>
                            </div>
                        </div>

                        {{-- Item 2: Visi --}}
                        <div class="flex items-start gap-6 group">
                            <div class="flex-shrink-0 w-20 h-20 rounded-full border-2 border-pmii-blue flex items-center justify-center text-pmii-blue group-hover:bg-pmii-blue group-hover:text-white transition-all duration-300 shadow-lg">
                                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pmii-blue transition-colors">Visi PMII SIDOARJO</h3>
                                <p class="text-gray-600 leading-relaxed text-sm">{{ $profil['visi'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-blue-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                @php
                    function renderStatCard($number, $label, $icon, $color, $statKey) {
                        // Ambil record dari model SiteSetting
                        $setting = \App\Models\SiteSetting::where('key', $statKey)->first();
                        $linkUrl = $setting?->link;

                        $tag = $linkUrl ? 'a' : 'div';
                        $attrs = $linkUrl ? "href=\"{$linkUrl}\" target=\"_blank\" rel=\"noopener\" title=\"Lihat data di spreadsheet\"" : '';
                        $cursorClass = $linkUrl ? 'cursor-pointer' : '';
                        $detailHtml = $linkUrl ? '<span class="text-xs text-pmii-blue/50 mt-1 block">↗ Lihat detail</span>' : '';

                        // Format warna icon
                        $bgClass = "bg-{$color}-100";
                        $textClass = "text-{$color}-600";
                        if ($color === 'blue') $textClass = 'text-pmii-blue';
                        $hoverBg = "group-hover:bg-{$color}-500";
                        if ($color === 'blue') $hoverBg = 'group-hover:bg-pmii-blue';

                        return "
                        <{$tag} {$attrs} class=\"bg-white rounded-xl p-8 shadow-lg text-center relative group hover:-translate-y-2 transition-transform duration-300 {$cursorClass}\" style=\"text-decoration:none;\">
                            <div class=\"w-16 h-16 mx-auto {$bgClass} {$textClass} rounded-full flex items-center justify-center -mt-16 ring-4 ring-white shadow-md mb-6 transition-colors {$hoverBg} group-hover:text-white\">
                                <i class=\"{$icon} text-2xl\"></i>
                            </div>
                            <h3 class=\"text-4xl font-extrabold text-gray-900 mb-2\">{$number}</h3>
                            <p class=\"text-gray-500 font-medium\">{$label}</p>
                            {$detailHtml}
                        </{$tag}>
                        ";
                    }
                @endphp

                <!-- Stat 1: Anggota Aktif -->
                {!! renderStatCard($stats['anggota_aktif'] ?? 1500, 'Anggota Aktif', 'fas fa-users', 'blue', 'anggota_aktif') !!}

                <!-- Stat 2: Alumni Kaderisasi -->
                {!! renderStatCard($stats['alumni_kaderisasi'] ?? 320, 'Alumni Kaderisasi', 'fas fa-user-graduate', 'yellow', 'alumni_kaderisasi') !!}

                <!-- Stat 3: Kegiatan Tahunan -->
                {!! renderStatCard($stats['kegiatan_tahunan'] ?? 45, 'Kegiatan Tahunan', 'fas fa-calendar-alt', 'green', 'kegiatan_tahunan') !!}

                <!-- Stat 4: Publikasi & Kajian -->
                {!! renderStatCard($stats['publikasi_kajian'] ?? 25, 'Publikasi & Kajian', 'fas fa-book-open', 'purple', 'publikasi_kajian') !!}

            </div>
        </div>
    </section>

    <!-- Headlines Section (60:40 Split) -->
    <section id="news" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex item-center justify-between mb-8">
             <h2 class="text-3xl font-bold text-pmii-blue flex items-center gap-3">
                <span class="w-2 h-10 bg-pmii-yellow rounded-full"></span>
                Berita Terbaru
            </h2>
            <a href="{{ route('articles.index') }}" class="text-sm font-medium text-gray-500 hover:text-pmii-blue transition-colors flex items-center gap-1">
                Lihat Semua Berita <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        @php
            $headlines = $posts->take(3);
            $others = $posts->skip(3);
        @endphp

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column (60%) - Main Headline -->
            <div class="lg:w-[60%]">
                @if($main = $headlines->first())
                <article class="relative h-[400px] md:h-[550px] rounded-2xl overflow-hidden group shadow-xl cursor-pointer">
                    <img src="{{ $main->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($main->image) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80' }}" 
                         class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                    
                    <div class="absolute bottom-0 left-0 p-6 md:p-10 w-full">
                        <span class="bg-pmii-yellow text-pmii-blue text-xs font-bold px-3 py-1 rounded-full mb-4 inline-block shadow">
                            {{ $main->category->name ?? 'Utama' }}
                        </span>
                        <h3 class="text-2xl md:text-4xl font-bold text-white mb-3 leading-tight group-hover:text-pmii-yellow transition-colors">
                            <a href="{{ route('posts.show', $main->slug) }}">{{ $main->title }}</a>
                        </h3>
                        <div class="flex items-center text-gray-300 text-sm gap-6 mt-4">
                            <span class="flex items-center gap-2"><i class="far fa-calendar-alt"></i> {{ $main->created_at->format('d M Y') }}</span>
                            <span class="flex items-center gap-2"><i class="far fa-user"></i> Admin</span>
                        </div>
                    </div>
                </article>
                @endif
            </div>

            <!-- Right Column (40%) - Sub Headlines (Stacked) -->
            <div class="lg:w-[40%] flex flex-col gap-8 h-auto md:h-[550px]">
                @foreach($headlines->slice(1, 2) as $sub)
                <article class="flex-1 bg-white rounded-2xl shadow-lg overflow-hidden relative group border border-gray-50 flex flex-col md:flex-row h-full">
                    <!-- Thumbnail -->
                    <div class="w-full md:w-5/12 relative overflow-hidden h-48 md:h-full">
                        <img src="{{ $sub->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($sub->image) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80' }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                         <div class="absolute top-2 left-2 md:hidden">
                            <span class="text-[10px] font-bold bg-pmii-yellow text-pmii-blue px-2 py-0.5 rounded">{{ $sub->category->name ?? 'News' }}</span>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="w-full md:w-7/12 p-5 flex flex-col justify-center relative">
                        <!-- Category Badge Desktop -->
                        <div class="hidden md:block absolute top-4 right-4 text-[10px] font-bold text-pmii-blue bg-blue-50 px-2 py-1 rounded-md">
                            {{ $sub->category->name ?? 'News' }}
                        </div>

                        <div class="text-xs text-gray-400 mb-2 flex items-center gap-2">
                             <span class="w-1.5 h-1.5 rounded-full bg-pmii-yellow"></span>
                             {{ $sub->created_at->diffForHumans() }}
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-3 leading-snug group-hover:text-pmii-blue transition-colors line-clamp-3">
                            <a href="{{ route('posts.show', $sub->slug) }}">{{ $sub->title }}</a>
                        </h4>
                        <a href="{{ route('posts.show', $sub->slug) }}" class="text-sm font-semibold text-pmii-blue hover:underline mt-auto flex items-center gap-1 group-hover/link:gap-2 transition-all">
                            Baca Selengkapnya <i class="fas fa-arrow-right text-xs transform group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Secondary Content Removed as per user request -->
    <!-- The page will now transition directly to footer -->
@endsection


