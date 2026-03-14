@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <div class="bg-gray-50 py-1 md:py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-sm font-bold text-gray-500 tracking-widest uppercase mb-2 block">LATEST UPDATE</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-pmii-blue uppercase">
                {{ $title ?? 'Artikel & Berita' }}
                <span class="block w-24 h-1.5 bg-pmii-yellow mt-4 mx-auto rounded-full"></span>
            </h1>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-24">
        
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($posts as $post)
            <article data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col h-full border border-gray-100">
                <!-- Image -->
                <div class="relative h-60 overflow-hidden">
                    <img src="{{ $post->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80' }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-pmii-yellow text-pmii-blue text-xs font-bold px-3 py-1 rounded-full shadow-md">
                            {{ $post->category->name ?? 'Update' }}
                        </span>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center text-xs text-gray-500 mb-3 gap-4">
                        <span class="flex items-center gap-1"><i class="far fa-clock"></i> {{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-pmii-blue transition-colors line-clamp-2">
                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center text-pmii-blue text-sm font-semibold hover:underline mt-auto">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $posts->links() }}
        </div>

        @else
        <div class="text-center py-20 text-gray-500">
            <i class="far fa-newspaper text-6xl text-gray-300 mb-4 block"></i>
            <p>Belum ada artikel terbaru.</p>
        </div>
        @endif

    </div>
@endsection
