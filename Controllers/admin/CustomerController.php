<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\UserModel;

class CustomerController extends BaseController
{
    protected $customerModel;
    protected $userModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Customer',
            'customers' => $this->customerModel->select('tb_customer.*, tb_user.nama, tb_user.username, tb_user.status')
                                              ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                                              ->paginate(10),
            'pager' => $this->customerModel->pager
        ];
        return view('admin/customer/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Customer',
            'users' => $this->userModel->where('level', 'customer')->where('status', 1)->findAll()
        ];
        return view('admin/customer/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required|is_unique[tb_user.username]',
            'password' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[tb_customer.email]',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Insert user first
        $userData = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => 'customer',
            'status' => 1
        ];

        $this->userModel->save($userData);
        $userId = $this->userModel->insertID();

        // Insert customer data
        $customerData = [
            'id_user' => $userId,
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp')
        ];

        $this->customerModel->save($customerData);
        return redirect()->to('/admin/customer')->with('success', 'Customer berhasil ditambahkan');
    }

    public function edit($id)
    {
        $customer = $this->customerModel->select('tb_customer.*, tb_user.nama, tb_user.username, tb_user.status')
                                       ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                                       ->where('tb_customer.id_customer', $id)
                                       ->first();
        
        if (!$customer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Customer',
            'customer' => $customer
        ];
        return view('admin/customer/edit', $data);
    }

    public function update($id)
    {
        $customer = $this->customerModel->find($id);
        
        if (!$customer) {
            return redirect()->to('/admin/customer')->with('error', 'Customer tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => "required|is_unique[tb_user.username,id_user,{$customer['id_user']}]",
            'email' => "required|valid_email|is_unique[tb_customer.email,id_customer,{$id}]",
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Update user data
        $userData = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'status' => $this->request->getPost('status')
        ];

        if ($this->request->getPost('password')) {
            $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($customer['id_user'], $userData);

        // Update customer data
        $customerData = [
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp')
        ];

        $this->customerModel->update($id, $customerData);
        return redirect()->to('/admin/customer')->with('success', 'Customer berhasil diupdate');
    }

    public function delete($id)
    {
        $customer = $this->customerModel->find($id);
        
        if (!$customer) {
            return redirect()->to('/admin/customer')->with('error', 'Customer tidak ditemukan');
        }
        
        // Delete customer first (due to foreign key)
        $this->customerModel->delete($id);
        // Then delete user
        $this->userModel->delete($customer['id_user']);
        
        return redirect()->to('/admin/customer')->with('success', 'Customer berhasil dihapus');
    }
}