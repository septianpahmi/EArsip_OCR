<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Surat Keputusan (SK)'],
            ['name' => 'Surat Edaran'],
            ['name' => 'Surat Masuk/Keluar'],
            ['name' => 'Notulensi Rapat'],
            ['name' => 'Laporan Tahunan'],
            ['name' => 'Berita Acara'],
            ['name' => 'Dokumen Akademik'],
            ['name' => 'Inventaris Barang'],
            ['name' => 'Lainnya'],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }
    }
}
