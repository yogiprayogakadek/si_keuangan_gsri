<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UangKeluarSeeder extends Seeder
{
    public function run()
    {
        $sumber = ['Sumbangan Sukarela', 'Persembahan', 'Kolekte', 'Dana Sosial', 'Hasil Usaha'];
        $keterangan = ['Sumbangan sukarela dari pihak luar', 'Uang yang diberikan oleh umat sebagai ungkapan rasa syukur', 'Uang yang dikumpulkan secara rutin', 'Dana yang dikumpulkan untuk kegiatan amal', 'Dana yang diperoleh dari kegiatan ekonomi yang dilakukan oleh gereja'];
        for ($i = 0; $i < 100; $i++) {
            $timestamp = mt_rand(strtotime('2025-03-01'), strtotime('2025-05-31'));
            $tanggal = date('Y-m-d', $timestamp);

            $data = [
                'jumlah'     => rand(100000, 1000000),
                'tujuan'     => $sumber[rand(0, 4)],
                'keterangan' => $keterangan[rand(0, 4)],
                'tanggal'    => $tanggal,
                'user_id'    => rand(2, 3),
            ];

            $this->db->table('uang_keluar')->insert($data);
        }
    }
}
