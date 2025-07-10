<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\WarehouseModel;

class WarehouseController extends BaseController
{
    protected $warehouseModel;

    public function __construct()
    {
        $this->warehouseModel = new WarehouseModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Warehouse',
            'warehouses' => $this->warehouseModel->paginate(10),
            'pager' => $this->warehouseModel->pager
        ];
        return view('admin/warehouse/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Warehouse'
        ];
        return view('admin/warehouse/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'lokasi' => 'required|min_length[3]',
            'kapasitas' => 'required|numeric|greater_than[0]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'lokasi' => $this->request->getPost('lokasi'),
            'kapasitas' => $this->request->getPost('kapasitas')
        ];

        $this->warehouseModel->save($data);
        return redirect()->to('/admin/warehouse')->with('success', 'Warehouse berhasil ditambahkan');
    }

    public function edit($id)
    {
        $warehouse = $this->warehouseModel->find($id);
        
        if (!$warehouse) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Warehouse tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Warehouse',
            'warehouse' => $warehouse
        ];
        return view('admin/warehouse/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'lokasi' => 'required|min_length[3]',
            'kapasitas' => 'required|numeric|greater_than[0]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'lokasi' => $this->request->getPost('lokasi'),
            'kapasitas' => $this->request->getPost('kapasitas')
        ];

        $this->warehouseModel->update($id, $data);
        return redirect()->to('/admin/warehouse')->with('success', 'Warehouse berhasil diupdate');
    }

    public function delete($id)
    {
        $warehouse = $this->warehouseModel->find($id);
        
        if (!$warehouse) {
            return redirect()->to('/admin/warehouse')->with('error', 'Warehouse tidak ditemukan');
        }
        
        $this->warehouseModel->delete($id);
        return redirect()->to('/admin/warehouse')->with('success', 'Warehouse berhasil dihapus');
    }
}