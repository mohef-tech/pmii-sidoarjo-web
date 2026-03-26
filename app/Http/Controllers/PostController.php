<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Slider;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        $galleries = Gallery::where('is_published', true)
            ->latest()
            ->take(8)
            ->get();

        $events = Event::where('is_published', true)
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $sliders = Slider::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        // Stats dari SiteSetting, fallback ke nilai default
        $stats = [
            'anggota_aktif'      => SiteSetting::get('anggota_aktif', 1500),
            'alumni_kaderisasi'  => SiteSetting::get('alumni_kaderisasi', 320),
            'kegiatan_tahunan'   => SiteSetting::get('kegiatan_tahunan', 45),
            'publikasi_kajian'   => SiteSetting::get('publikasi_kajian', 25),
        ];

        // Profil section settings
        $profilMediaType = SiteSetting::get('profil_media_type', 'image');
        $profilMediaRaw  = SiteSetting::get('profil_media', '');

        // Jika tipe video: konversi URL YouTube biasa → URL embed
        $profilMedia = $profilMediaType === 'video'
            ? SiteSetting::youtubeEmbedUrl($profilMediaRaw)
            : $profilMediaRaw;

        $profil = [
            'media'      => $profilMedia,
            'media_type' => $profilMediaType,
            'judul'      => SiteSetting::get('profil_judul', 'Pergerakan Mahasiswa Islam Indonesia'),
            'deskripsi'  => SiteSetting::get('profil_deskripsi', 'PMII merupakan organisasi gerakan dan kaderisasi yang berlandaskan islam ahlussunah waljamaah. Berdiri sejak tanggal 17 April 1960 di Surabaya dan hingga lebih dari setengah abad kini PMII terus eksis untuk memberikan kontribusi bagi kemajuan bangsa dan negara.'),
            'tujuan'     => SiteSetting::get('profil_tujuan', 'Terbentuknya pribadi muslim Indonesia yang bertakwa kepada Allah Swt, Berbudi luhur, berilmu, cakap dan bertanggungjawab dalam mengamalkan ilmunya serta komitmen memperjuangkan cita-cita kemerdekaan Indonesia.'),
            'visi'       => SiteSetting::get('profil_visi', 'Menguatkan Profesionalitas Organisasi Menuju Era Baru PMII'),
        ];

        return view('home', compact('posts', 'galleries', 'events', 'sliders', 'stats', 'profil'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->with('category')
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    public function articles()
    {
        $posts = Post::where('is_published', true)
            ->with('category')
            ->latest()
            ->paginate(9);

        $title = "Artikel & Berita";
        return view('posts.index', compact('posts', 'title'));
    }
}
