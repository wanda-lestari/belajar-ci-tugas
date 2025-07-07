<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class ApiController extends ResourceController
{
    protected $apiKey = 'YOUR_API_KEY_HERE'; // Ganti dengan API Key kamu
    protected $transaction;
    protected $transaction_detail;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    /**
     * Menampilkan data transaksi dan detailnya jika API Key valid
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'results' => [],
            'status' => [
                'code' => 401,
                'description' => 'Unauthorized'
            ]
        ];

        $key = $this->request->getHeaderLine('Key');

        if ($key === $this->apiKey) {
            $penjualan = $this->transaction->findAll();

            foreach ($penjualan as &$pj) {
                $pj['details'] = $this->transaction_detail
                    ->where('transaction_id', $pj['id'])
                    ->findAll();
            }

            $data['status'] = [
                'code' => 200,
                'description' => 'OK'
            ];
            $data['results'] = $penjualan;
        }

        return $this->respond($data);
    }

    // Sisanya biarkan default dulu, bisa diisi nanti jika dibutuhkan
    public function show($id = null) { }
    public function new() { }
    public function create() { }
    public function edit($id = null) { }
    public function update($id = null) { }
    public function delete($id = null) { }
}
