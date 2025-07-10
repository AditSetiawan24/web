<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'users' => $this->userModel->paginate(10),
            'pager' => $this->userModel->pager
        ];
        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];
        return view('admin/user/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required|is_unique[tb_user.username]',
            'password' => 'required|min_length[3]',
            'level' => 'required|in_list[customer,admin]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level'),
            'status' => $this->request->getPost('status') ?? 1
        ];

        $this->userModel->save($data);
        return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => "required|is_unique[tb_user.username,id_user,{$id}]",
            'level' => 'required|in_list[customer,admin]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
            'status' => $this->request->getPost('status')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/user')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan');
        }
        
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus');
    }
} 