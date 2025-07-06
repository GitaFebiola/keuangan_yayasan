<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimensiSeeder extends Seeder
{
    public function run(): void
    {
        // Pemasukan
        DB::table('dim_pemasukan')->insert([
            ['jenis' => 'Dana BOS'],
            ['jenis' => 'Sumbangan Pembinaan Pendidikan'],
            ['jenis' => 'Donasi'],
        ]);

        // Pengeluaran
        DB::table('dim_pengeluaran')->insert([
            ['jenis' => 'Gaji Guru dan Karyawan'],
            ['jenis' => 'Kegiatan Sekolah'],
            ['jenis' => 'Biaya Pemeliharaan Perbaikan Fasilitas'],
            ['jenis' => 'Biaya Operasional'],
        ]);

        // Unit
        DB::table('dim_unit')->insert([
            ['nama' => 'SD'],
            ['nama' => 'SMP'],
            ['nama' => 'SMA'],
        ]);

        // Rekening
        DB::table('dim_rekening')->insert([
            ['bank' => 'BCA'],
            ['bank' => 'BRK'],
            ['bank' => 'BRI'],
            ['bank' => 'Mandiri'],
            ['bank' => 'Lainnya'],
        ]);
    }
}
