<?php

namespace App\Controllers;

use App\Models\UangKeluarModel;
use App\Models\UangMasukModel;

class DashbordController extends BaseController
{
    public function index(): string
    {
        return view('main\dashboard\index');
    }

    public function filter()
    {
        $modelMasuk = new UangMasukModel();
        $modelKeluar = new UangKeluarModel();

        $start = $this->request->getPost('start_date');
        $end = $this->request->getPost('end_date');

        if (!$start || !$end) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Tanggal tidak valid']);
        }

        $dataMasuk = $modelMasuk->getUangMasuk($start, $end);
        $dataKeluar = $modelKeluar->getUangKeluar($start, $end);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'uang_masuk' => [
                    'labels' => array_column($dataMasuk, 'tanggal'),
                    'jumlah' => array_column($dataMasuk, 'jumlah')
                ],
                'uang_keluar' => [
                    'labels' => array_column($dataKeluar, 'tanggal'),
                    'jumlah' => array_column($dataKeluar, 'jumlah')
                ]
            ]
        ]);

        
    }
}
