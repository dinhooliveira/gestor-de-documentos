<?php


namespace App\Controllers;

use Config\Services;

class CustomerLogin extends \App\Controllers\BaseController
{

    private $CustomerModel;
    private $session;

    public function __construct()
    {
        $this->session = Services::session();
        $this->CustomerModel = new \App\Models\CustomerModel();
    }

    public function index()
    {
        $data["message"] = $this->session->getFlashdata("message") ?? $this->session->getFlashdata("message");
        return view('customer-login', $data);
    }

    public function login()
    {
        try {

            $customer = $this->CustomerModel->where('email', $this->request->getPost('email'))->first();
            if (!$customer) {
                throw new \Exception("E-mail não encontrado!");
            }
            if (!password_verify($this->request->getPost('password'), $customer->password)) {
                throw new \Exception("Senha não confere");
            }
            $this->session->set('customer',$customer);
            return redirect()->to('/customer/home');

        } catch (\Exception $ex) {
            return redirect()->with('message', $ex->getMessage())->withInput()->to('/CustomerLogin');
        }


    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('/CustomerLogin');
    }

}
