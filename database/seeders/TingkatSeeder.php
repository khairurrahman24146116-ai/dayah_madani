<?php

namespace Database\Seeders;

use App\Models\Tingkat;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class TingkatSeeder extends Seeder
{
    public function run(): void
    {
        $smp = Tingkat::create([
            'kode' => 'SMP',
            'nama' => 'SMP (Madrasah Tsanawiyah)',
            'deskripsi' => 'Sekolah Menengah Pertama / Madrasah Tsanawiyah',
        ]);

        $sma = Tingkat::create([
            'kode' => 'SMA',
            'nama' => 'SMA (Madrasah Aliyah)',
            'deskripsi' => 'Sekolah Menengah Atas / Madrasah Aliyah',
        ]);

        $aliyah = Tingkat::create([
            'kode' => 'ALIYAH',
            'nama' => 'Aliyah (Mengaji)',
            'deskripsi' => 'Tingkat mengaji Aliyah setara SMP',
        ]);

        $mahad = Tingkat::create([
            'kode' => 'MAHAD',
            'nama' => "Ma'had (Mengaji)",
            'deskripsi' => 'Tingkat mengaji Ma\'had setara SMA',
        ]);

        Kelas::create(['tingkat_id' => $smp->id, 'kode' => 'SMP-7', 'nama' => 'Kelas 7 SMP']);
        Kelas::create(['tingkat_id' => $smp->id, 'kode' => 'SMP-8', 'nama' => 'Kelas 8 SMP']);
        Kelas::create(['tingkat_id' => $smp->id, 'kode' => 'SMP-9', 'nama' => 'Kelas 9 SMP']);

        Kelas::create(['tingkat_id' => $sma->id, 'kode' => 'SMA-10', 'nama' => 'Kelas 10 SMA']);
        Kelas::create(['tingkat_id' => $sma->id, 'kode' => 'SMA-11', 'nama' => 'Kelas 11 SMA']);
        Kelas::create(['tingkat_id' => $sma->id, 'kode' => 'SMA-12', 'nama' => 'Kelas 12 SMA']);

        Kelas::create(['tingkat_id' => $aliyah->id, 'kode' => 'ALIYAH-1', 'nama' => 'Aliyah 1']);
        Kelas::create(['tingkat_id' => $aliyah->id, 'kode' => 'ALIYAH-2', 'nama' => 'Aliyah 2']);
        Kelas::create(['tingkat_id' => $aliyah->id, 'kode' => 'ALIYAH-3', 'nama' => 'Aliyah 3']);

        Kelas::create(['tingkat_id' => $mahad->id, 'kode' => 'MAHAD-1', 'nama' => "Ma'had 1"]);
        Kelas::create(['tingkat_id' => $mahad->id, 'kode' => 'MAHAD-2', 'nama' => "Ma'had 2"]);
        Kelas::create(['tingkat_id' => $mahad->id, 'kode' => 'MAHAD-3', 'nama' => "Ma'had 3"]);
    }
}
