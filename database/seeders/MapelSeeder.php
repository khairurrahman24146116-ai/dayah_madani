<?php

namespace Database\Seeders;

use App\Models\Mapel;
use App\Models\Tingkat;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $smp = Tingkat::where('kode', 'SMP')->first();
        $sma = Tingkat::where('kode', 'SMA')->first();
        $aliyah = Tingkat::where('kode', 'ALIYAH')->first();
        $mahad = Tingkat::where('kode', 'MAHAD')->first();

        $smpMapel = [
            ['kode' => 'MTK-SMP', 'nama' => 'Matematika', 'kategori' => 'umum'],
            ['kode' => 'IPA-SMP', 'nama' => 'Ilmu Pengetahuan Alam', 'kategori' => 'umum'],
            ['kode' => 'IPS-SMP', 'nama' => 'Ilmu Pengetahuan Sosial', 'kategori' => 'umum'],
            ['kode' => 'BINDO-SMP', 'nama' => 'Bahasa Indonesia', 'kategori' => 'umum'],
            ['kode' => 'BING-SMP', 'nama' => 'Bahasa Inggris', 'kategori' => 'umum'],
            ['kode' => 'PAI-SMP', 'nama' => 'Pendidikan Agama Islam', 'kategori' => 'umum'],
            ['kode' => 'PPKN-SMP', 'nama' => 'Pendidikan Pancasila', 'kategori' => 'umum'],
            ['kode' => 'OR-SMP', 'nama' => 'Olahraga', 'kategori' => 'umum'],
            ['kode' => 'SBK-SMP', 'nama' => 'Seni Budaya', 'kategori' => 'umum'],
            ['kode' => 'TIK-SMP', 'nama' => 'Informatika', 'kategori' => 'umum'],
        ];

        $smaMapel = [
            ['kode' => 'MTK-SMA', 'nama' => 'Matematika', 'kategori' => 'umum'],
            ['kode' => 'FISIKA', 'nama' => 'Fisika', 'kategori' => 'umum'],
            ['kode' => 'KIMIA', 'nama' => 'Kimia', 'kategori' => 'umum'],
            ['kode' => 'BIO', 'nama' => 'Biologi', 'kategori' => 'umum'],
            ['kode' => 'BINDO-SMA', 'nama' => 'Bahasa Indonesia', 'kategori' => 'umum'],
            ['kode' => 'BING-SMA', 'nama' => 'Bahasa Inggris', 'kategori' => 'umum'],
            ['kode' => 'PAI-SMA', 'nama' => 'Pendidikan Agama Islam', 'kategori' => 'umum'],
            ['kode' => 'SEJARAH', 'nama' => 'Sejarah', 'kategori' => 'umum'],
            ['kode' => 'PPKN-SMA', 'nama' => 'Pendidikan Pancasila', 'kategori' => 'umum'],
            ['kode' => 'EKONOMI', 'nama' => 'Ekonomi', 'kategori' => 'umum'],
        ];

        $aliyahMapel = [
            ['kode' => 'AQIDAH', 'nama' => 'Aqidah Akhlaq', 'kategori' => 'salafi'],
            ['kode' => 'FIQH', 'nama' => 'Fiqh Ibadah', 'kategori' => 'salafi'],
            ['kode' => 'HADITS', 'nama' => 'Hadits', 'kategori' => 'salafi'],
            ['kode' => 'NAHWU', 'nama' => 'Nahwu', 'kategori' => 'salafi'],
            ['kode' => 'SHARAF', 'nama' => 'Sharaf', 'kategori' => 'salafi'],
            ['kode' => 'TAFSIR', 'nama' => 'Tafsir Al-Qur\'an', 'kategori' => 'salafi'],
            ['kode' => 'TARIKH', 'nama' => 'Tarikh Islam', 'kategori' => 'salafi'],
            ['kode' => 'ARAB', 'nama' => 'Bahasa Arab', 'kategori' => 'salafi'],
            ['kode' => 'TAJWID', 'nama' => 'Tajwid', 'kategori' => 'salafi'],
        ];

        $mahadMapel = [
            ['kode' => 'TAHFIDZ', 'nama' => 'Tahfidz Al-Qur\'an', 'kategori' => 'pondok'],
            ['kode' => 'QIRAAT', 'nama' => 'Qira\'at', 'kategori' => 'pondok'],
            ['kode' => 'TADABBUR', 'nama' => 'Tadabbur', 'kategori' => 'pondok'],
            ['kode' => 'AMALIYYAH', 'nama' => 'Amaliyyah Yaumiyyah', 'kategori' => 'pondok'],
            ['kode' => 'BALAGHAH', 'nama' => 'Balaghah', 'kategori' => 'pondok'],
            ['kode' => 'USUL_FIQH', 'nama' => 'Ushul Fiqh', 'kategori' => 'pondok'],
            ['kode' => 'MANTHIQ', 'nama' => 'Manthiq', 'kategori' => 'pondok'],
        ];

        foreach ($smpMapel as $mapel) { $smp->mapel()->create($mapel); }
        foreach ($smaMapel as $mapel) { $sma->mapel()->create($mapel); }
        foreach ($aliyahMapel as $mapel) { $aliyah->mapel()->create($mapel); }
        foreach ($mahadMapel as $mapel) { $mahad->mapel()->create($mapel); }
    }
}
