@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">

    {{-- ===== HEADER ===== --}}
    <div class="bg-gray-50 py-1 md:py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between text-center md:text-left">
            <div class="mb-4 md:mb-0">
                <span class="text-sm font-bold text-gray-500 tracking-widest uppercase mb-2 block">KOPRI</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-pmii-blue uppercase leading-tight">E-Magazine KOPRI</h1>
                <span class="block w-24 h-1.5 bg-pmii-yellow mt-4 mx-auto md:mx-0 rounded-full"></span>
            </div>
            <p class="text-gray-500 max-w-md text-center md:text-right text-sm">
                Kumpulan majalah digital KOPRI PMII Sidoarjo — baca langsung atau unduh ke perangkat Anda.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-24">

        @if($magazines->isEmpty())
            <div class="text-center py-28 text-gray-400">
                <i class="fas fa-book-open text-6xl mb-5 block text-gray-200"></i>
                <p class="text-lg font-medium">Belum ada e-magazine yang tersedia.</p>
                <p class="text-sm mt-1">Pantau terus ya, edisi terbaru akan segera hadir!</p>
            </div>
        @else

        @php $featured = $magazines->first(); $rest = $magazines->skip(1); @endphp

        {{-- ===== FEATURED ===== --}}
        <div data-aos="fade-up" class="mb-16">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-1 h-6 bg-pmii-yellow rounded-full"></span>
                <h2 class="text-lg font-bold text-gray-700 uppercase tracking-wider">Edisi Terbaru</h2>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row" style="min-height:420px;">

                {{-- KIRI: Cover --}}
                @if($featured->cover_image)
                <div style="width:38%;flex-shrink:0;min-height:300px;position:relative;background-image:url('{{ Storage::disk('public')->url($featured->cover_image) }}');background-size:cover;background-position:center;">
                    <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent 60%,rgba(10,30,94,0.6));"></div>
                @else
                <div style="width:38%;flex-shrink:0;min-height:300px;position:relative;background:linear-gradient(135deg,#FFC107 0%,#ff9800 55%,#e65100 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <div style="width:88px;height:88px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                        <i class="fas fa-book" style="font-size:2.5rem;color:white;"></i>
                    </div>
                    <span style="color:rgba(255,255,255,0.8);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">No Cover</span>
                @endif
                </div>

                {{-- KANAN: Info --}}
                <div class="flex flex-col justify-center p-8 md:p-12" style="flex:1;background:linear-gradient(135deg,#0a1e5e 0%,#1a3a8f 100%);">
                    @if($featured->edition)
                        <span class="text-pmii-yellow text-xs font-extrabold tracking-[3px] uppercase mb-3 block">{{ $featured->edition }}</span>
                    @endif
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">{{ $featured->title }}</h2>
                    <div class="w-12 h-1 bg-pmii-yellow rounded-full mb-5"></div>
                    <p class="text-white font-medium text-sm mb-8 flex items-center gap-2">
                        <i class="far fa-calendar-alt text-pmii-yellow"></i>
                        {{ $featured->created_at->translatedFormat('d F Y') }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button
                            onclick="openFlipbook('{{ Storage::disk('public')->url($featured->file) }}', '{{ addslashes($featured->title) }}')"
                            class="inline-flex items-center gap-3 bg-pmii-yellow text-pmii-blue font-bold px-8 py-4 rounded-xl hover:bg-yellow-400 transition-all shadow-lg hover:shadow-yellow-400/30 hover:-translate-y-0.5 text-base cursor-pointer">
                            <i class="fas fa-book-open text-base"></i> Baca Online
                        </button>
                        <a href="{{ Storage::disk('public')->url($featured->file) }}"
                           download="{{ $featured->title }}.pdf"
                           class="inline-flex items-center gap-3 border-2 border-white/40 text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/10 hover:border-white/70 transition-all text-base">
                            <i class="fas fa-download text-base"></i> Download PDF
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== GRID FLIPBOOK — Edisi Lainnya ===== --}}
        @if($rest->isNotEmpty())
        <div class="flex items-center gap-4 mb-8">
            <span class="w-1 h-6 bg-pmii-yellow rounded-full"></span>
            <h2 class="text-lg font-bold text-gray-700 uppercase tracking-wider">Edisi Lainnya</h2>
            <div class="h-px bg-gray-200 flex-1"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($rest as $index => $magazine)
            <div data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 80 }}"
                 class="flip-card" style="perspective:1000px;aspect-ratio:3/4;">
                <div class="flip-card-inner w-full h-full relative" style="transform-style:preserve-3d;transition:transform 0.65s cubic-bezier(.4,0,.2,1);">
                    {{-- DEPAN --}}
                    <div class="flip-card-front absolute inset-0 rounded-2xl overflow-hidden shadow-lg" style="backface-visibility:hidden;-webkit-backface-visibility:hidden;">
                        @if($magazine->cover_image)
                            <img src="{{ Storage::disk('public')->url($magazine->cover_image) }}" alt="{{ $magazine->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center" style="background:linear-gradient(135deg,#FFC107,#e65100);">
                                <i class="fas fa-book text-5xl text-white/60 mb-2"></i>
                                <span class="text-white/60 text-xs">No Cover</span>
                            </div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 h-2/5 bg-gradient-to-t from-black/70 to-transparent"></div>
                        @if($magazine->edition)
                        <span class="absolute top-3 left-3 bg-pmii-yellow text-pmii-blue text-[10px] font-bold px-2 py-0.5 rounded shadow leading-tight">{{ $magazine->edition }}</span>
                        @endif
                        <p class="absolute bottom-4 left-3 right-3 text-white text-xs font-bold line-clamp-2 leading-snug">{{ $magazine->title }}</p>
                        <div class="absolute top-3 right-3 w-7 h-7 bg-black/30 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20">
                            <i class="fas fa-sync-alt text-[9px] text-white/80"></i>
                        </div>
                    </div>
                    {{-- BELAKANG --}}
                    <div class="flip-card-back absolute inset-0 rounded-2xl overflow-hidden shadow-xl flex flex-col items-center justify-center p-5 text-center"
                         style="backface-visibility:hidden;-webkit-backface-visibility:hidden;transform:rotateY(180deg);background:linear-gradient(135deg,#0a1e5e 0%,#1a3a8f 100%);">
                        <div class="w-12 h-12 bg-pmii-yellow/20 rounded-full flex items-center justify-center mb-3 ring-2 ring-pmii-yellow/30">
                            <i class="fas fa-book text-pmii-yellow text-xl"></i>
                        </div>
                        @if($magazine->edition)
                            <span class="text-pmii-yellow text-[10px] font-extrabold tracking-widest uppercase mb-1 block">{{ $magazine->edition }}</span>
                        @endif
                        <h3 class="text-white font-bold text-sm leading-snug mb-2 line-clamp-3">{{ $magazine->title }}</h3>
                        <p class="text-white text-[11px] font-medium mb-5 flex items-center gap-1 justify-center">
                            <i class="far fa-calendar-alt text-pmii-yellow text-[10px]"></i>
                            {{ $magazine->created_at->format('d M Y') }}
                        </p>
                        <div class="flex flex-col gap-2 w-full">
                            <button
                                onclick="openFlipbook('{{ Storage::disk('public')->url($magazine->file) }}', '{{ addslashes($magazine->title) }}')"
                                class="w-full bg-pmii-yellow text-pmii-blue text-xs font-bold py-2.5 rounded-lg hover:bg-yellow-400 transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                <i class="fas fa-book-open text-[10px]"></i> Baca Online
                            </button>
                            <a href="{{ Storage::disk('public')->url($magazine->file) }}"
                               download="{{ $magazine->title }}.pdf"
                               class="w-full border border-white/30 text-white text-xs font-semibold py-2.5 rounded-lg hover:bg-white/15 transition-colors flex items-center justify-center gap-1.5">
                                <i class="fas fa-download text-[10px]"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @endif
    </div>
</div>

{{-- ████████████████████  FLIPBOOK READER MODAL  ████████████████████ --}}
<div id="flipbook-modal" style="display:none;position:fixed;inset:0;z-index:9999;background:#1a1a2e;flex-direction:column;">

    {{-- TOP BAR --}}
    <div id="fb-topbar" style="display:flex;align-items:center;justify-content:space-between;padding:10px 20px;background:rgba(0,0,0,0.5);backdrop-filter:blur(8px);flex-shrink:0;">
        <span id="fb-title" style="color:#FFC107;font-weight:700;font-size:14px;letter-spacing:0.5px;"></span>
        <button onclick="closeFlipbook()" style="background:rgba(255,255,255,0.12);border:none;color:white;width:34px;height:34px;border-radius:50%;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">✕</button>
    </div>

    {{-- CONTENT AREA --}}
    <div style="display:flex;flex:1;overflow:hidden;position:relative;">

        {{-- THUMBNAIL PANEL --}}
        <div id="fb-thumb-panel" style="width:0;overflow:hidden;background:#111122;transition:width 0.3s ease;flex-shrink:0;">
            <div style="width:190px;padding:16px 12px;height:100%;overflow-y:auto;box-sizing:border-box;">
                <div style="color:white;font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:12px;opacity:0.6;">Halaman</div>
                <div id="fb-thumb-list" style="display:flex;flex-direction:column;gap:10px;"></div>
            </div>
        </div>

        {{-- STAGE --}}
        <div id="fb-stage" style="flex:1;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">

            {{-- LOADING --}}
            <div id="fb-loading" style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;color:white;z-index:10;">
                <div id="fb-spinner" style="width:44px;height:44px;border:3px solid rgba(255,193,7,0.2);border-top-color:#FFC107;border-radius:50%;animation:fb-spin 0.8s linear infinite;margin-bottom:14px;"></div>
                <span id="fb-loading-text" style="font-size:13px;opacity:0.7;">Memuat PDF...</span>
            </div>

            {{-- PREV --}}
            <button id="fb-prev" onclick="fbPrev()" style="position:absolute;left:16px;z-index:5;background:rgba(255,255,255,0.12);border:none;color:white;width:44px;height:44px;border-radius:50%;font-size:20px;cursor:pointer;display:none;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.28)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">‹</button>

            {{-- FLIPBOOK CANVAS CONTAINER --}}
            <div id="fb-container" style="position:relative;display:none;"></div>

            {{-- NEXT --}}
            <button id="fb-next" onclick="fbNext()" style="position:absolute;right:16px;z-index:5;background:rgba(255,255,255,0.12);border:none;color:white;width:44px;height:44px;border-radius:50%;font-size:20px;cursor:pointer;display:none;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.28)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">›</button>

        </div>
    </div>

    {{-- TOOLBAR --}}
    <div id="fb-toolbar" style="display:flex;align-items:center;justify-content:space-between;padding:10px 24px;background:rgba(0,0,0,0.6);backdrop-filter:blur(8px);flex-shrink:0;">

        {{-- KIRI: Thumbnails --}}
        <div style="display:flex;align-items:center;gap:8px;">
            <button id="btn-thumb" onclick="toggleThumbnails()" title="Halaman" style="background:rgba(255,255,255,0.1);border:none;color:white;width:36px;height:36px;border-radius:8px;font-size:15px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background=thumbOpen?'rgba(255,193,7,0.3)':'rgba(255,255,255,0.1)'">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            </button>
        </div>

        {{-- TENGAH: Page Indicator --}}
        <div style="display:flex;align-items:center;gap:6px;">
            <span id="fb-page-indicator" style="color:white;font-size:13px;font-weight:600;opacity:0.9;">— / —</span>
        </div>

        {{-- KANAN: Zoom + Fullscreen --}}
        <div style="display:flex;align-items:center;gap:6px;">
            <button onclick="fbZoomOut()" title="Zoom Out" style="background:rgba(255,255,255,0.1);border:none;color:white;width:36px;height:36px;border-radius:8px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">−</button>
            <button onclick="fbZoomIn()" title="Zoom In" style="background:rgba(255,255,255,0.1);border:none;color:white;width:36px;height:36px;border-radius:8px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">+</button>
            <button onclick="fbFullscreen()" title="Fullscreen" style="background:rgba(255,255,255,0.1);border:none;color:white;width:36px;height:36px;border-radius:8px;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M3 3h6v2H5v4H3V3zm12 0h6v6h-2V5h-4V3zM3 15h2v4h4v2H3v-6zm16 4h-4v2h6v-6h-2v4z"/></svg>
            </button>
        </div>
    </div>
</div>

{{-- PDF.js + StPageFlip CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>

<script>
// ─── Config ───────────────────────────────────────────
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

let pageFlipInstance = null;
let pdfDoc = null;
let totalPages = 0;
let currentZoom = 1.0;
let thumbOpen = false;
const RENDER_SCALE = 1.8;   // kualitas render
const PAGE_W = 420;         // lebar satu halaman (px)

// ─── OPEN ──────────────────────────────────────────────
async function openFlipbook(pdfUrl, title) {
    const modal = document.getElementById('flipbook-modal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    document.getElementById('fb-title').textContent = title;
    document.getElementById('fb-loading').style.display = 'flex';
    document.getElementById('fb-container').style.display = 'none';
    document.getElementById('fb-prev').style.display = 'none';
    document.getElementById('fb-next').style.display = 'none';
    document.getElementById('fb-thumb-list').innerHTML = '';
    document.getElementById('fb-page-indicator').textContent = '— / —';
    currentZoom = 1.0;
    thumbOpen = false;
    document.getElementById('fb-thumb-panel').style.width = '0';

    // destroy old instance
    if (pageFlipInstance) { try { pageFlipInstance.destroy(); } catch(e){} pageFlipInstance = null; }
    document.getElementById('fb-container').innerHTML = '';

    try {
        pdfDoc = await pdfjsLib.getDocument({ url: pdfUrl, withCredentials: false }).promise;
        totalPages = pdfDoc.numPages;
        document.getElementById('fb-loading-text').textContent = `Merender ${totalPages} halaman...`;

        // Render semua halaman → canvas array
        const canvases = [];
        for (let i = 1; i <= totalPages; i++) {
            document.getElementById('fb-loading-text').textContent = `Memuat halaman ${i} / ${totalPages}...`;
            const page   = await pdfDoc.getPage(i);
            const vp     = page.getViewport({ scale: RENDER_SCALE });
            const canvas = document.createElement('canvas');
            canvas.width  = vp.width;
            canvas.height = vp.height;
            await page.render({ canvasContext: canvas.getContext('2d'), viewport: vp }).promise;
            canvases.push(canvas);
        }

        // Build StPageFlip
        const stageH = document.getElementById('fb-stage').clientHeight - 40;
        const pageH  = Math.min(stageH, PAGE_W * (canvases[0].height / canvases[0].width));
        const pageW  = pageH * (canvases[0].width / canvases[0].height);

        const container = document.getElementById('fb-container');
        container.style.width  = (pageW * 2) + 'px';
        container.style.height = pageH + 'px';

        pageFlipInstance = new St.PageFlip(container, {
            width: pageW, height: pageH,
            showCover: true,
            flippingTime: 600,
            usePortrait: false,
            startPage: 0,
            autoSize: false,
            maxShadowOpacity: 0.4,
            mobileScrollSupport: false,
        });

        // Tambah halaman dari canvas
        const imgEls = canvases.map(c => {
            const img = document.createElement('img');
            img.src = c.toDataURL('image/jpeg', 0.92);
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
            return img;
        });
        pageFlipInstance.loadFromImages(imgEls.map(img => img.src));

        // Update indicator on flip
        pageFlipInstance.on('flip', e => updateIndicator(e.data));
        pageFlipInstance.on('changeState', () => updateIndicator(pageFlipInstance.getCurrentPageIndex()));

        // Build thumbnails
        buildThumbnails(canvases);

        // Show UI
        document.getElementById('fb-loading').style.display = 'none';
        container.style.display = 'block';
        document.getElementById('fb-prev').style.display = 'flex';
        document.getElementById('fb-next').style.display = 'flex';
        updateIndicator(0);

    } catch (err) {
        console.error('Flipbook error:', err);
        document.getElementById('fb-loading-text').textContent = 'Gagal memuat PDF. Coba lagi.';
    }
}

// ─── THUMBNAILS ───────────────────────────────────────
function buildThumbnails(canvases) {
    const list = document.getElementById('fb-thumb-list');
    list.innerHTML = '';
    canvases.forEach((c, i) => {
        const wrapper = document.createElement('div');
        wrapper.style.cssText = 'cursor:pointer;border-radius:6px;overflow:hidden;border:2px solid transparent;transition:border-color 0.2s;';
        wrapper.title = `Halaman ${i + 1}`;
        const img = document.createElement('img');
        img.src = c.toDataURL('image/jpeg', 0.6);
        img.style.cssText = 'width:100%;display:block;';
        const lbl = document.createElement('div');
        lbl.style.cssText = 'text-align:center;color:rgba(255,255,255,0.5);font-size:10px;padding:3px 0;background:#111122;';
        lbl.textContent = i + 1;
        wrapper.append(img, lbl);
        wrapper.onclick = () => {
            if (pageFlipInstance) pageFlipInstance.flip(i);
            wrapper.style.borderColor = '#FFC107';
        };
        wrapper.onmouseover = () => wrapper.style.borderColor = 'rgba(255,193,7,0.5)';
        wrapper.onmouseout  = () => wrapper.style.borderColor = 'transparent';
        list.appendChild(wrapper);
    });
}

function toggleThumbnails() {
    thumbOpen = !thumbOpen;
    document.getElementById('fb-thumb-panel').style.width = thumbOpen ? '190px' : '0';
    document.getElementById('btn-thumb').style.background = thumbOpen ? 'rgba(255,193,7,0.3)' : 'rgba(255,255,255,0.1)';
}

// ─── NAVIGATION ───────────────────────────────────────
function fbPrev() { if (pageFlipInstance) pageFlipInstance.flipPrev(); }
function fbNext() { if (pageFlipInstance) pageFlipInstance.flipNext(); }

function updateIndicator(pageIndex) {
    document.getElementById('fb-page-indicator').textContent = `${pageIndex + 1} / ${totalPages}`;
}

// ─── ZOOM ─────────────────────────────────────────────
function fbZoomIn()  { currentZoom = Math.min(currentZoom + 0.2, 2.2); applyZoom(); }
function fbZoomOut() { currentZoom = Math.max(currentZoom - 0.2, 0.4); applyZoom(); }
function applyZoom() {
    document.getElementById('fb-container').style.transform = `scale(${currentZoom})`;
    document.getElementById('fb-container').style.transformOrigin = 'center center';
}

// ─── FULLSCREEN ───────────────────────────────────────
function fbFullscreen() {
    const el = document.getElementById('flipbook-modal');
    if (!document.fullscreenElement) {
        el.requestFullscreen && el.requestFullscreen();
    } else {
        document.exitFullscreen && document.exitFullscreen();
    }
}

// ─── CLOSE ────────────────────────────────────────────
function closeFlipbook() {
    document.getElementById('flipbook-modal').style.display = 'none';
    document.body.style.overflow = '';
    if (document.fullscreenElement) document.exitFullscreen();
    if (pageFlipInstance) { try { pageFlipInstance.destroy(); } catch(e){} pageFlipInstance = null; }
    pdfDoc = null;
}

// Tekan Escape untuk tutup
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeFlipbook(); });
</script>

<style>
/* Flip card CSS */
.flip-card { cursor:pointer; }
.flip-card:hover .flip-card-inner { transform: rotateY(180deg); }

/* Spinner */
@keyframes fb-spin { to { transform: rotate(360deg); } }

/* Thumbnail panel transition */
#fb-thumb-panel > div { width: 190px; }

/* Scrollbar tipis untuk thumb panel */
#fb-thumb-panel ::-webkit-scrollbar { width: 4px; }
#fb-thumb-panel ::-webkit-scrollbar-track { background: transparent; }
#fb-thumb-panel ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }
</style>
@endsection
