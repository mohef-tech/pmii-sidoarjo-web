<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    // Sembunyikan dari sidebar.
    // Untuk mengaktifkan kembali di masa depan, ubah nilai ini menjadi true
    // atau hapus baris ini (default Filament = true). Jangan lupa hapus
    // juga method mount() di bawah agar halaman Dashboard bisa tampil normal.
    protected static bool $shouldRegisterNavigation = false;

    public function mount(): void
    {
        $this->redirect('/admin/sliders');
    }
}
