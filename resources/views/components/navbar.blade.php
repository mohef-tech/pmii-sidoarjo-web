<nav x-data="{ open: false, scrolled: {{ request()->is('/') ? 'false' : 'true' }} }" 
     @if(request()->is('/')) @scroll.window="scrolled = (window.pageYOffset > 20)" @endif
     :class="{ 'bg-pmii-blue/90 backdrop-blur-md shadow-md py-0': scrolled, 'bg-transparent py-2': !scrolled }"
     class="fixed w-full z-50 transition-all duration-300 ease-in-out top-0 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center transition-all duration-300" :class="{ 'h-16': scrolled, 'h-24': !scrolled }">
            <!-- Logo Section -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="/" class="flex items-center gap-3 group">
                    <!-- LOGO: Ganti file 'logo.png' di folder public/images/ -->
                    <img src="{{ asset('images/logo.png') }}" 
                         onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/6/69/Logo_PMII.png'" 
                         class="h-12 w-auto transition-transform group-hover:scale-105" 
                         alt="Logo PMII">
                    <span class="font-bold text-2xl text-white tracking-wider flex items-center gap-2">
                        PMII SIDOARJO
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:ml-10 md:flex md:items-center md:space-x-8">
                @foreach([
                    ['label' => 'Beranda', 'route' => '/'],
                    ['label' => 'Profil', 'route' => request()->is('/') ? '#profil' : url('/#profil')],
                    ['label' => 'Pengajuan SK', 'route' => route('sk.index')],
                    ['label' => 'Gallery', 'route' => route('gallery.index')],
                    ['label' => 'Pengurus', 'route' => route('pengurus.index')],
                    ['label' => 'Artikel', 'route' => route('articles.index')],
                ] as $menu)
                    <a href="{{ $menu['route'] }}" class="relative text-white font-medium text-sm transition-colors group py-2">
                        {{ $menu['label'] }}
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-400 transform origin-left transition-transform duration-300 {{ ($menu['label'] == 'Pengajuan SK' && request()->routeIs('sk.index')) || (request()->fullUrl() == $menu['route'] && $menu['label'] != 'Pengajuan SK') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                @endforeach
                
                <a href="{{ route('downloads.index') }}" class="text-white hover:text-gray-200 text-sm font-medium transition-colors relative group py-2">
                    File Download
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-400 transform origin-left transition-transform duration-300 {{ request()->routeIs('downloads.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>
                <a href="{{ route('emagazine.index') }}" class="text-white hover:text-gray-200 text-sm font-medium transition-colors relative group py-2">
                    E-Magazine
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-400 transform origin-left transition-transform duration-300 {{ request()->routeIs('emagazine.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-gray-200 text-sm font-medium transition-colors relative group py-2">
                    Kontak
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-400 transform origin-left transition-transform duration-300 {{ request()->routeIs('contact.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="text-white inline-flex items-center justify-center p-2 rounded-md hover:text-yellow-400 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-blue-900/95 backdrop-blur-md shadow-lg absolute w-full top-24 border-t border-blue-800">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Beranda</a>
            <a href="{{ request()->is('/') ? '#profil' : url('/#profil') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Profil</a>
            <a href="{{ route('sk.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Pengajuan SK</a>
            <a href="{{ route('gallery.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Gallery</a>
            <a href="{{ route('pengurus.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Pengurus</a>
            <a href="{{ route('articles.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Artikel</a>
            <a href="{{ route('downloads.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">File Download</a>
            <a href="{{ route('emagazine.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">E-Magazine</a>
            <a href="{{ route('contact.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800">Kontak</a>
        </div>
    </div>
</nav>
