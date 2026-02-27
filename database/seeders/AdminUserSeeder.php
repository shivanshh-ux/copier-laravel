<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::updateOrCreate(
            ['username' => 'emperorcopier@2026'],
            ['password' => Hash::make('emperorcopier2026@')]
        );
    }
}
