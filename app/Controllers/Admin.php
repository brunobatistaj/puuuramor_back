<?php
namespace App\Controllers;

use App\Models\AnimalModel;
use App\Models\ProdutoModel;
use App\Models\BannerModel;

class Admin extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $user = $this->request->getPost('user');
            $pass = $this->request->getPost('password');
            
            if ($user === 'admin' && $pass === 'admin') {
                session()->set('logged_in', true);
                return redirect()->to('/admin/dashboard');
            }
        }
        return view('admin/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/dashboard');
    }
}
