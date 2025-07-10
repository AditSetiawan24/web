<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Check if user is logged in and is admin
        if (!session()->get('ses_Login') || session()->get('ses_Level') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $userId = session()->get('ses_IdUser');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'title' => 'Pengaturan Akun',
            'user' => $user
        ];

        return view('admin/profile/index', $data);
    }

    public function update()
    {
        // Check if user is logged in and is admin
        if (!session()->get('ses_Login') || session()->get('ses_Level') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $userId = session()->get('ses_IdUser');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'username' => "required|is_unique[tb_user.username,id_user,{$userId}]",
            'password_lama' => 'permit_empty',
            'password_baru' => 'permit_empty|min_length[3]',
            'konfirmasi_password' => 'permit_empty|matches[password_baru]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username')
        ];

        // Jika user ingin mengubah password
        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');

        if (!empty($passwordLama) && !empty($passwordBaru)) {
            // Verifikasi password lama
            if (!password_verify($passwordLama, $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'Password lama tidak sesuai');
            }
            
            // Hash password baru
            $data['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $this->userModel->update($userId, $data);

        // Update session username jika berubah
        session()->set('ses_Username', $data['username']);

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diupdate');
    }

    public function changePassword()
    {
        // Check if user is logged in and is admin
        if (!session()->get('ses_Login') || session()->get('ses_Level') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $userId = session()->get('ses_IdUser');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'title' => 'Ubah Password',
            'user' => $user
        ];

        return view('admin/profile/change_password', $data);
    }

    public function updatePassword()
    {
        // Check if user is logged in and is admin
        if (!session()->get('ses_Login') || session()->get('ses_Level') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $userId = session()->get('ses_IdUser');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'password_lama' => 'required',
            'password_baru' => 'required|min_length[3]',
            'konfirmasi_password' => 'required|matches[password_baru]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');

        // Verifikasi password lama
        if (!password_verify($passwordLama, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }

        // Update password
        $this->userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/admin/profile')->with('success', 'Password berhasil diubah');
    }
}