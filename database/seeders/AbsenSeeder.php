<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Absen senin jam je 1-4
        collect([
            [
                "kode_guru" => 63,
                "id_kelas" => 15,
                "keterangan" => "Jam Ke - 4 Masuk Di Kelas XI-TJKT-1 Pada Senin, 6 Nov 2023 Pukul 09:10:26 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 09:10:26",
                "updated_at" => "2023-11-06 09:10:26",
            ],
            [
                "kode_guru" => 63,
                "id_kelas" => 15,
                "keterangan" => "Jam Ke - 3 Masuk Di Kelas XI-TJKT-1 Pada Senin, 6 Nov 2023 Pukul 09:10:26 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 09:10:26",
                "updated_at" => "2023-11-06 09:10:26",
            ],
            [
                "kode_guru" => 63,
                "id_kelas" => 15,
                "keterangan" => "Jam Ke - 2 Masuk Di Kelas XI-TJKT-1 Pada Senin, 6 Nov 2023 Pukul 09:10:26 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 09:10:26",
                "updated_at" => "2023-11-06 09:10:26",
            ],
            [
                "kode_guru" => 63,
                "id_kelas" => 15,
                "keterangan" => "Jam Ke - 1 Kelas XI-TJKT-1 Telat",
                "status_hadir" => 0,
                "created_at" => "2023-11-06 09:10:26",
                "updated_at" => "2023-11-06 09:10:26",
            ],

        ])->each(function ($jadwal) {
            Absensi::create($jadwal);
        });


        //Absen senin jam je 5 - 8
        collect([
            [
                "kode_guru" => 63,
                "id_kelas" => 18,
                "keterangan" => "Jam Ke - 8 Masuk Di Kelas XI-TJKT-4 Pada Senin, 6 Nov 2023 Pukul 11:30:02 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 11:30:02",
                "updated_at" => "2023-11-06 11:30:02",
            ],
            [
                "kode_guru" => 63,
                "id_kelas" => 18,
                "keterangan" => "Jam Ke - 7 Masuk Di Kelas XI-TJKT-4 Pada Senin, 6 Nov 2023 Pukul 11:30:02 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 11:30:02",
                "updated_at" => "2023-11-06 11:30:02",
            ],
            [
                "kode_guru" => 63,
                "id_kelas" => 18,
                "keterangan" => "Jam Ke - 6 Masuk Di Kelas XI-TJKT-4 Pada Senin, 6 Nov 2023 Pukul 11:30:02 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 11:30:02",
                "updated_at" => "2023-11-06 11:30:02",
            ],
            [
                "kode_guru" => 63,
                "id_kelas" => 18,
                "keterangan" => "Jam Ke - 5 Masuk Di Kelas XI-TJKT-4 Pada Senin, 6 Nov 2023 Pukul 11:30:02 WIB",
                "status_hadir" => 1,
                "created_at" => "2023-11-06 11:30:02",
                "updated_at" => "2023-11-06 11:30:02",
            ],

        ])->each(function ($jadwal) {
            Absensi::create($jadwal);
        });


        //Absen selasa jam ke 3 - 6
        collect([
            [
                "kode_guru" => "63",
                "keterangan" => "Jam Ke - 6 Masuk Dikelas XI-TJKT-3 Pada Selasa, 7 Nov 2023 Pukul 09:31:41 WIB",
                "status_hadir" => "1",
                "id_kelas" => "17",
                "updated_at" => "2023-11-07 09:31:41",
                "created_at" => "2023-11-07 09:31:41",
            ],
            [
                "kode_guru" => "63",
                "keterangan" => "Jam Ke - 5 Masuk Dikelas XI-TJKT-3 Pada Selasa, 7 Nov 2023 Pukul 09:31:41 WIB",
                "status_hadir" => "1",
                "id_kelas" => "17",
                "updated_at" => "2023-11-07 09:31:41",
                "created_at" => "2023-11-07 09:31:41",
            ],
            [
                "kode_guru" => "63",
                "keterangan" => "Jam Ke - 4 Masuk Dikelas XI-TJKT-3 Pada Selasa, 7 Nov 2023 Pukul 09:31:41 WIB",
                "status_hadir" => "1",
                "id_kelas" => "17",
                "updated_at" => "2023-11-07 09:31:41",
                "created_at" => "2023-11-07 09:31:41",
            ],
            [
                "kode_guru" => "63",
                "keterangan" => "Jam Ke - 3 Dikelas XI-TJKT-3 Telat",
                "status_hadir" => "0",
                "id_kelas" => "17",
                "updated_at" => "2023-11-07 09:31:41",
                "created_at" => "2023-11-07 09:31:41",
            ],

        ])->each(function ($jadwal) {
            Absensi::create($jadwal);
        });
    }
}
