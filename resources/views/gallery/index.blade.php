@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen" 
         x-data="{ 
            open: false, 
            currentIndex: 0, 
            images: {{ Js::from($galleries) }},
            get activeImage() {
                return this.images[this.currentIndex];
            },
            get imageUrl() {
                if (!this.activeImage) return '';
                // Handle text that might be full URL vs relative path
                let img = this.activeImage.image_path || this.activeImage.image;
                if (img && img.startsWith('http')) return img;
                return '/storage/' + img;
            },
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            },
            close() {
                this.open = false;
            }
         }"
         @keydown.escape.window="close()">
         
        <!-- 
            PENGATURAN JARAK NAVBAR DI HALAMAN INI:
            - 'pt-24': (Optional) Tambahkan class ini jika ingin memberi jarak paksa dari atas. 
            Saat ini menggunakan 'py-12' (padding vertical) yang sudah cukup manis.
            Jika ingin lebih turun: ubah 'py-12' jadi 'pt-32 pb-12' misalnya.
        -->
        <div class="bg-gray-50 py-1 md:py-5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">
                <span class="text-sm font-bold text-gray-500 tracking-widest uppercase mb-2 block">Gallery</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-pmii-blue">
                    PMII SIDOARJO Gallery
                    <span class="block w-24 h-1.5 bg-pmii-yellow mt-4 mx-auto md:mx-0 rounded-full"></span>
                </h1>
            </div>
        </div>

        <!-- Grid Gallery -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <template x-for="(image, index) in images" :key="index">
                    <div data-aos="fade-up" :data-aos-delay="index * 100" class="group relative aspect-[4/3] rounded-xl overflow-hidden cursor-pointer shadow-md hover:shadow-xl transition-all duration-300"
                         @click="open = true; currentIndex = index">
                        <img :src="image.image_path ? (image.image_path.startsWith('http') ? image.image_path : '/storage/' + image.image_path) : '/storage/' + image.image" 
                             :alt="image.title"
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                             onerror="this.onerror=null;this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'%3E%3Crect width=\'100\' height=\'100\' fill=\'%23e5e7eb\'/%3E%3Ctext x=\'50\' y=\'55\' font-size=\'30\' text-anchor=\'middle\' fill=\'%239ca3af\'%3E🖼%3C/text%3E%3C/svg%3E';">
                        
                        <!-- Overlay on Hover -->
                        <div class="absolute inset-0 bg-pmii-blue/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                </template>
            </div>
            
            <div x-show="images.length === 0" class="text-center py-20 text-gray-500">
                <p>Belum ada galeri foto.</p>
            </div>
        </div>

        <!-- Lightbox Modal -->
        <template x-teleport="body">
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-sm"
                 @click.self="close()">

                <!-- Close Button -->
                <button @click="close()" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-[10000]">
                    <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <!-- Navigation - Prev -->
                <button @click="prev()" class="absolute left-4 md:left-8 text-white/50 hover:text-white transition-colors z-[10000] p-2 hover:bg-white/10 rounded-full">
                    <svg class="w-8 h-8 md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <!-- Navigation - Next -->
                <button @click="next()" class="absolute right-4 md:right-8 text-white/50 hover:text-white transition-colors z-[10000] p-2 hover:bg-white/10 rounded-full">
                    <svg class="w-8 h-8 md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <!-- Image Container -->
                <div class="relative w-full h-full max-w-7xl max-h-[90vh] flex items-center justify-center p-4"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-300 delay-100"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90">
                    
                    <img :src="imageUrl" 
                         class="w-full object-contain shadow-2xl rounded-lg"
                         style="max-height: 80vh;"
                         @click.stop
                         onerror="this.onerror=null;this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%231f2937\'/%3E%3Ctext x=\'200\' y=\'140\' font-size=\'60\' text-anchor=\'middle\' fill=\'%234b5563\'%3E🖼%3C/text%3E%3Ctext x=\'200\' y=\'195\' font-size=\'16\' text-anchor=\'middle\' fill=\'%236b7280\'%3EGambar tidak ditemukan%3C/text%3E%3C/svg%3E';">
                    
                    <!-- Caption (Optional) -->
                    <div x-show="activeImage && activeImage.title"
                         class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/60 px-6 py-3 rounded-full text-white text-sm md:text-base font-medium backdrop-blur-md max-w-[90%] text-center">
                        <span x-text="activeImage.title"></span>
                    </div>

                </div>
            </div>
        </template>
    </div>
@endsection
