<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Perpus',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        Buku::create([
            'kode_buku' => 'BK-001',
            'judul' => 'Pemrograman Web Laravel Dasar',
            'pengarang' => 'Eko Kurniawan',
            'penerbit' => 'Media Ilmu',
            'stok' => 5,
        ]);

        Buku::create([
            'kode_buku' => 'BK-002',
            'judul' => 'Belajar Basis Data MySQL untuk Pemula',
            'pengarang' => 'Budi Raharjo',
            'penerbit' => 'Informatika',
            'stok' => 3,
        ]);
    }
}
