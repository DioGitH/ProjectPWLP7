<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            [
                'mahasiswa_Nim' => 2141720041,
                'matakuliah_id' => 1,
                'nilai' => 60,
            ],
            [
                'mahasiswa_Nim' => 2141720041,
                'matakuliah_id' => 2,
                'nilai' => 80,
            ],
            [
                'mahasiswa_Nim' => 2141720041,
                'matakuliah_id' => 3,
                'nilai' => 90,
            ],
            [
                'mahasiswa_Nim' => 2141720041,
                'matakuliah_id' => 4,
                'nilai' => 70,
            ],
            [
                'mahasiswa_Nim' => 552,
                'matakuliah_id' => 1,
                'nilai' => 60,
            ],
            [
                'mahasiswa_Nim' => 552,
                'matakuliah_id' => 2,
                'nilai' => 80,
            ],
            [
                'mahasiswa_Nim' => 552,
                'matakuliah_id' => 3,
                'nilai' => 90,
            ],
            [
                'mahasiswa_Nim' => 552,
                'matakuliah_id' => 4,
                'nilai' => 70,
            ],
        ];

        DB::table('mahasiswa_matakuliah')->insert($nilai);
    }
}
