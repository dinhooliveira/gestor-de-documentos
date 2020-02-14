<?php


namespace App\Controllers;

use Config\Services;

class UserLogin extends \App\Controllers\BaseController
{

    private $UserModel;
    private $session;

    public function __construct()
    {
        $this->session = Services::session();
        $this->UserModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $data["message"] = $this->session->getFlashdata("message") ?? $this->session->getFlashdata("message");
        return view('user-login', $data);
    }

    public function login()
    {
        try {

            $user = $this->UserModel->where('email', $this->request->getPost('email'))->first();
            if (!$user) {
                throw new \Exception("E-mail não encontrado!");
            }
            if (!password_verify($this->request->getPost('password'), $user->password)) {
                throw new \Exception("Senha não confere");
            }
            $this->session->set('user',$user);
            return redirect()->to('/admin/home');

        } catch (\Exception $ex) {
            return redirect()->with('message', $ex->getMessage())->withInput()->to('/UserLogin');
        }


    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('/UserLogin');
    }

}
