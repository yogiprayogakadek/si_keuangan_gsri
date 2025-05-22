<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\UangMasuk;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UangKeluarModel;
use App\Models\UangMasukModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class UangKeluarController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UangKeluarModel();
    }

    public function currentSaldo()
    {
        $uangMasukModel = new UangMasukModel();
        $totalUangMasuk = $uangMasukModel->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;
        $totalUangKeluar = $this->model->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;
        return $totalUangMasuk - $totalUangKeluar;
    }

    public function index()
    {
        $data = $this->model
                ->select('uang_keluar.*, users.username as username')
                ->join('users', 'users.id = uang_keluar.user_id')
                ->findAll();
        return view('main\uang-keluar\index', ['data' => $data]);
    }

    public function create()
    {
        return view('main\uang-keluar\create', ['saldo' => $this->currentSaldo()]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'tanggal' => 'required|valid_date',
            'jumlah'  => 'required',
            'tujuan'  => 'required|string',
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
            'tujuan' => [
                'required' => 'Tujuan harus diisi.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $jumlah = preg_replace('/[^\d]/', '', $this->request->getPost('jumlah'));

            if($this->currentSaldo() >= $jumlah) {
                $this->model->insert([
                    'tanggal'    => $this->request->getPost('tanggal'),
                    'jumlah'     => $jumlah,
                    'tujuan'     => $this->request->getPost('tujuan'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'user_id'    => 1
                ]);
    
                return redirect()->to('/uang-keluar')->with('success', 'Data berhasil disimpan.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Jumlah yang anda masukkan melebihi saldo saat ini');
            }


        } catch (\Exception $e) {
            // Kirim error ke halaman sebelumnya melalui session flashdata
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        return view('main\uang-keluar\update', [
            'data' => $data,
            'saldo' => $this->currentSaldo() + $data['jumlah']
        ]);
    }

    public function update()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'tanggal' => 'required|valid_date',
            'jumlah'  => 'required',
            'tujuan'  => 'required|string',
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
            'tujuan' => [
                'required' => 'Tujuan harus diisi.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $data = $this->model->find($this->request->getPost('id'));
            $jumlah = preg_replace('/[^\d]/', '', $this->request->getPost('jumlah'));
            $saldo = $this->currentSaldo() + $data['jumlah'];
            if($saldo >= $jumlah) {
                $this->model->update(
                    $this->request->getPost('id'),
                    [
                        'tanggal'    => $this->request->getPost('tanggal'),
                        'jumlah'     => $jumlah,
                        'tujuan'     => $this->request->getPost('tujuan'),
                        'keterangan' => $this->request->getPost('keterangan'),
                        'user_id'    => session()->get('user_id')
                    ]
                );
                return redirect()->to('/uang-keluar')->with('success', 'Data berhasil diupdate.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Jumlah yang anda masukkan melebihi saldo saat ini');
            }

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
        $uangMasukModel = new UangMasukModel();
        $startDate = $this->request->getPost('start_date');
        $endDate   = $this->request->getPost('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal harus dipilih.');
        }
        $data = $this->model
                ->select('uang_keluar.*, users.username AS username')
                ->join('users', 'users.id = uang_keluar.user_id')
                ->where('uang_keluar.tanggal >=', $startDate)
                ->where('uang_keluar.tanggal <=', $endDate)
                ->orderBy('uang_keluar.tanggal', 'ASC')
                ->findAll();

        $totalUangKeluar = $this->model
                ->selectSum('jumlah')
                ->where('tanggal >=', $startDate)
                ->where('tanggal <=', $endDate)
                ->get()
                ->getRow()
                ->jumlah ?? 0;
        $totalUangMasuk = $this->model
                ->selectSum('jumlah')
                ->where('tanggal >=', $startDate)
                ->where('tanggal <=', $endDate)
                ->get()
                ->getRow()
                ->jumlah ?? 0;

        // Load view HTML
        $html = view('main\uang-keluar\print', [
            'data' => $data,
            'saldo' => $totalUangMasuk - $totalUangKeluar,
            'totalUangMasuk' => $totalUangMasuk,
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
