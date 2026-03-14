<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pmiisidoarjo.or.id'],
            [
                'name'     => 'Admin PMII Sidoarjo',
                'password' => Hash::make('pmii123'),
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat: admin@pmiisidoarjo.or.id / pmii123');
    }
}
