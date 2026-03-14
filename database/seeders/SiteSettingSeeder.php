<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // ── Statistik (angka di homepage)
            'anggota_aktif'      => ['value' => '1500', 'label' => 'Anggota Aktif'],
            'alumni_kaderisasi'  => ['value' => '320',  'label' => 'Alumni Kaderisasi'],
            'kegiatan_tahunan'   => ['value' => '45',   'label' => 'Kegiatan Tahunan'],
            'publikasi_kajian'   => ['value' => '25',   'label' => 'Publikasi & Kajian'],

            // ── Beranda – Link
            'link_stats_spreadsheet' => ['value' => '', 'label' => 'Link Spreadsheet Statistik (klik kartu angka)'],
            'link_bergabung'         => ['value' => 'https://drive.google.com/drive/my-drive?hl=ID', 'label' => 'Link Tombol "Bergabung dengan Kami"'],


            // ── Profil section (kiri: foto/video · kanan: teks)
            'profil_media'       => ['value' => '',     'label' => 'Profil – Foto/Video (upload path atau URL YouTube embed)'],
            'profil_media_type'  => ['value' => 'image','label' => 'Profil – Tipe Media (image / video)'],
            'profil_judul'       => ['value' => 'Pergerakan Mahasiswa Islam Indonesia', 'label' => 'Profil – Judul'],
            'profil_deskripsi'   => ['value' => 'PMII merupakan organisasi gerakan dan kaderisasi yang berlandaskan islam ahlussunah waljamaah. Berdiri sejak tanggal 17 April 1960 di Surabaya dan hingga lebih dari setengah abad kini PMII terus eksis untuk memberikan kontribusi bagi kemajuan bangsa dan negara.', 'label' => 'Profil – Deskripsi'],
            'profil_tujuan'      => ['value' => 'Terbentuknya pribadi muslim Indonesia yang bertakwa kepada Allah Swt, Berbudi luhur, berilmu, cakap dan bertanggungjawab dalam mengamalkan ilmunya serta komitmen memperjuangkan cita-cita kemerdekaan Indonesia.', 'label' => 'Profil – Tujuan PMII'],
            'profil_visi'        => ['value' => 'Menguatkan Profesionalitas Organisasi Menuju Era Baru PMII', 'label' => 'Profil – Visi PMII Sidoarjo'],

            // ── Kontak Organisasi
            'kontak_alamat'      => ['value' => 'Jl. Capung No.114, Kwadengan Barat, Lemahputro, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61213', 'label' => 'Kontak – Alamat / Lokasi'],
            'kontak_email'       => ['value' => 'pcpmiisda@gmail.com', 'label' => 'Kontak – Email'],
            'kontak_wa_list'     => ['value' => json_encode([
                ['nomor' => '6282232619640'],
                ['nomor' => '628975566202']
            ]), 'label' => 'Daftar Nomor WhatsApp'],

            // ── Sosial Media
            'sosmed_facebook'    => ['value' => '', 'label' => 'Sosmed – Facebook URL'],
            'sosmed_instagram'   => ['value' => '', 'label' => 'Sosmed – Instagram URL'],
            'sosmed_twitter'     => ['value' => '', 'label' => 'Sosmed – Twitter/X URL'],
            'sosmed_youtube'     => ['value' => '', 'label' => 'Sosmed – YouTube URL'],
        ];

        foreach ($defaults as $key => $data) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $data['value'], 'label' => $data['label']]
            );
        }

        $this->command->info('✅ SiteSetting defaults berhasil di-seed.');
    }
}
