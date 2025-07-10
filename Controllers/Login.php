<?php

namespace App\Controllers;
use App\Models\M_login;

class Login extends BaseController
{
    public function f_login(): string
    {
        return view('v_login');
    }
    
    public function authlogin()
    {
        $ModelLogin = new M_login();
        $username = $this->request->getPost('usn');
        $password = $this->request->getPost('pswd');
        
        $user = $ModelLogin->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            session()->set('ses_Login', true);
            session()->set('ses_IdUser', $user['id_user']);
            session()->set('ses_Level', $user['level']);
            session()->set('ses_Username', $user['username']);
            
            if ($user['level'] == 'admin') {
                return redirect()->to(base_url('admin/home'));
            } elseif ($user['level'] == 'customer') {
                return redirect()->to(base_url('/'));
            } else {
                // Jika level tidak dikenali
                return redirect()->to(base_url('/'));
            }
        } else {
            // Login gagal
            return redirect()->to(base_url('login'))->with('error', 'Username atau password salah');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'))->with('success', 'Berhasil logout');
    }
}