<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Mahasiswa::factory(10)->create();
        Kaprodi::factory()->create();
        Dosen::factory(5)->create();
    }
}
