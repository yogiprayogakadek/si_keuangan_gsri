<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\UangMasuk;
use App\Models\UangKeluarModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UangMasukModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class UangMasukController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UangMasukModel();
    }

    public function index()
    {
        $data = $this->model
                ->select('uang_masuk.*, users.username as username')
                ->join('users', 'users.id = uang_masuk.user_id')
                ->findAll();
        return view('main\uang-masuk\index', ['data' => $data]);
    }

    public function create()
    {
        return view('main\uang-masuk\create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'tanggal' => 'required|valid_date',
            'jumlah'  => 'required',
            'sumber'  => 'required|string',
            'keterangan' => 'permit_empty|string'
        ];

        $messages = [
            'tanggal' => [
                'required' => 'Tanggal harus diisi.',
                'valid_date' => 'Tanggal tidak valid.'
            ],
            'jumlah' => [
                'required' => 'Jumlah uang harus diisi.'
            ],
            'sumber' => [
                'required' => 'Sumber harus diisi.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $this->model->insert([
                'tanggal'    => $this->request->getPost('tanggal'),
                'jumlah'     => preg_replace('/[^\d]/', '', $this->request->getPost('jumlah')),
                'sumber'     => $this->request->getPost('sumber'),
                'keterangan' => $this->request->getPost('keterangan'),
                'user_id'    => session()->get('user_id')
            ]);

            return redirect()->to('/uang-masuk')->with('success', 'Data berhasil disimpan.');

        } catch (\Exception $e) {
            // Kirim error ke halaman sebelumnya melalui session flashdata
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        return view('main\uang-masuk\update', [
            'data' => $data
        ]);
    }

    public function update()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'tanggal' => 'required|valid_date',
            'jumlah'  => 'required',
            'sumber'  => 'required|string',
            'keterangan' => 'permit_empty|string'
        ];

        $messages = [
            'tanggal' => [
                'required' => 'Tanggal harus diisi.',
                'valid_date' => 'Tanggal tidak valid.'
            ],
            'jumlah' => [
                'required' => 'Jumlah uang harus diisi.'
            ],
            'sumber' => [
                'required' => 'Sumber harus diisi.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $this->model->update(
                $this->request->getPost('id'),
                [
                    'tanggal'    => $this->request->getPost('tanggal'),
                    'jumlah'     => preg_replace('/[^\d]/', '', $this->request->getPost('jumlah')),
                    'sumber'     => $this->request->getPost('sumber'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'user_id'    => session()->get('user_id')
                ]
            );

            return redirect()->to('/uang-masuk')->with('success', 'Data berhasil diupdate.');

        } catch (\Exception $e) {
            // Kirim error ke halaman sebelumnya melalui session flashdata
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->model->delete($id);
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function print()
    {
        $uangKeluarModel = new UangKeluarModel();
        $startDate = $this->request->getPost('start_date');
        $endDate   = $this->request->getPost('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal harus dipilih.');
        }
        $data = $this->model
                ->select('uang_masuk.*, users.username AS username')
                ->join('users', 'users.id = uang_masuk.user_id')
                ->where('uang_masuk.tanggal >=', $startDate)
                ->where('uang_masuk.tanggal <=', $endDate)
                ->orderBy('uang_masuk.tanggal', 'ASC')
                ->findAll();
        
        $totalUangMasuk = $this->model
                            ->selectSum('jumlah')
                            ->where('tanggal >=', $startDate)
                            ->where('tanggal <=', $endDate)
                            ->get()
                            ->getRow()
                            ->jumlah ?? 0;
        $totalUangKeluar = $uangKeluarModel
                            ->selectSum('jumlah')
                            ->where('tanggal >=', $startDate)
                            ->where('tanggal <=', $endDate)
                            ->get()
                            ->getRow()
                            ->jumlah ?? 0;

        // Load view HTML
        $html = view('main\uang-masuk\print', [
            'data' => $data,
            'saldo' => $totalUangMasuk - $totalUangKeluar,
            'totalUangKeluar' => $totalUangKeluar,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        // Set Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // untuk gambar dari URL

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // atau 'landscape'
        $dompdf->render();

        // Download file PDF
        return $this->response->setHeader('Content-Type', 'application/pdf')
                            ->setBody($dompdf->output());
    }
}
