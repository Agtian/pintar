<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MasterRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        MasterRole::create([
            'role_name' => 'pertugas_diklat',
        ]);

        MasterRole::create([
            'role_name' => 'admin',
        ]);

        MasterRole::create([
            'role_name' => 'kasir',
        ]);

        MasterRole::create([
            'role_name' => 'peserta_mou',
        ]);

        MasterRole::create([
            'role_name' => 'peserta_diklat',
        ]);

        User::factory(5)->create();
    }
}
