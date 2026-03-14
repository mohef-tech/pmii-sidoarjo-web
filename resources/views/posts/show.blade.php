@extends('layouts.app')

@section('content')
    <!-- Hero Section with Background Image -->
    <div class="relative h-[60vh] min-h-[400px] w-full bg-gray-900">
        @if($post->image)
            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($post->image) }}"
                 alt="{{ $post->title }}"
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-gray-900 opacity-80"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
            <div class="max-w-4xl mx-auto" data-aos="fade-up">
                <div class="flex items-center gap-4 text-sm md:text-base text-gray-300 mb-4">
                    <span class="bg-blue-600 px-3 py-1 rounded-full text-white font-semibold text-xs">
                        {{ $post->category->name ?? 'Berita' }}
                    </span>
                    <span>{{ $post->created_at->format('d F Y') }}</span>
                </div>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    {{ $post->title }}
                </h1>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="bg-white min-h-screen">
        <div class="max-w-4xl mx-auto px-4 md:px-8 py-12 md:py-20">

            <!-- Back Button -->
            <div class="mb-12" data-aos="fade-right">
                <a href="{{ route('articles.index') }}"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Artikel
                </a>
            </div>

            <!-- Post Content — render HTML dari RichEditor -->
            <article class="prose prose-lg md:prose-xl max-w-none text-gray-800 leading-relaxed" data-aos="fade-up">
                {!! $post->content !!}
            </article>

            <!-- Share Buttons (Fungsional) -->
            <div class="mt-16 pt-8 border-t border-gray-200" data-aos="fade-up">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan Artikel Ini</h3>
                <div class="flex flex-wrap gap-3">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>

                    {{-- Twitter / X --}}
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition text-sm font-medium">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . request()->url()) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm font-medium">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>

                    {{-- Copy Link --}}
                    <button onclick="navigator.clipboard.writeText('{{ request()->url() }}').then(() => this.textContent = '✓ Disalin!')"
                            class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm font-medium">
                        <i class="fas fa-link"></i> Salin Link
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
