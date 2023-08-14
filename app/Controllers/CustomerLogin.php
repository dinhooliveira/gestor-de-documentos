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
        $data['linkForgotPassword'] = base_url('CustomerLogin/forgotPassword');
        $data["messageInfo"] = $this->session->getFlashdata("messageInfo") ?? $this->session->getFlashdata("messageInfo");
        $data["message"] = $this->session->getFlashdata("message") ?? $this->session->getFlashdata("message");
        return view('customer-login', $data);
    }

    public function login()
    {
        try {

            $customer = $this->CustomerModel->where('email', $this->request->getPost('email'))->first();
            if (!$customer) {
                throw new \Exception(lang('Login.messageEmailNotFound'));
            }
            if (!password_verify($this->request->getPost('password'), $customer->password)) {
                throw new \Exception(lang('Login.messagePasswordErro'));
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

    public function forgotPassword()
    {
        $data['urlForgotPasswordAction'] = base_url('CustomerLogin/sendEmailForgotPassword');
        $data["erros"] = $this->session->getFlashdata("erros") ?? $this->session->getFlashdata("erros");
        return view('forgot-password', $data);
    }

    public function sendEmailForgotPassword()
    {

        helper(['url', 'text']);
        $result = redirect();
        $validation = \Config\Services::validation();
        try {

            $validation->setRule('email', 'E-mail', 'required|valid_email');
            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }


            $customer = $this->CustomerModel->where(['email' => $this->request->getPost('email')])->first();
            if (empty($customer)) {
                throw new \Exception(lang('Login.messageEmailNotFound'));
            }

            $forgot_password = random_string('alnum', 8);
            $customer = $customer->setForgotPassword($forgot_password);
            if (!$this->CustomerModel->update($customer->id, $customer)) {
                throw new \Exception(lang('Login.messageChangePasswordErro'));
            }

            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setSubject(lang('Login.textEmailMessage'));
            $textLinkChangePassword = lang('Login.linkEmailText');
            $linkChangePassword = base_url("CustomerLogin/changePassword/{$customer->forgot_password}");
            $email->setMessage("<b> <a href='{$linkChangePassword}'>{$textLinkChangePassword}</a> </b>");
            $message = lang('Login.messageChangePassword') . "<br>";
            if (!$email->send()) {
                $message = lang('Login.messageChangePasswordEmailErro');
            }

            $result->with('messageInfo', $message)->to('/CustomerLogin');

        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case 97 :
                    $result = $result->with('erros', $validation->getErrors());
                    break;
                default:
                    $result = $result->with('erros', [$ex->getMessage()]);
                    break;

            }
            $result = $result->withInput()->to('/CustomerLogin/forgotPassword');
        }

        return $result;


    }

    public function changePassword($hash = null)
    {
        if (empty($hash)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $customer = $this->CustomerModel->where('forgot_password', $hash)->first();
        if (empty($customer)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['user'] = $customer;
        $data['urlChangePasswordAction'] = base_url("/CustomerLogin/changePasswordAction/{$hash}");
        $data["erros"] = $this->session->getFlashdata("erros") ?? $this->session->getFlashdata("erros");
        return view('forgot-password-form', $data);
    }

    public function changePasswordAction($hash = null)
    {

        if (empty($hash)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        helper(['url']);
        $result = redirect();
        try {
            $validation = \Config\Services::validation();
            $validation->setRule('password', 'Password', 'required|min_length[8]|max_length[14]');
            $validation->setRule('cpassword', 'Conf. Password', 'required|matches[password]');
            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            $customer = $this->CustomerModel->where('forgot_password', $hash)->first();
            if (empty($customer)) {
                throw new \Exception(null, 404);
            }
            $customer = $customer->setPassword($this->request->getPost('password'));
            $customer = $customer->clearForgotPassword();

            if (!$this->CustomerModel->update($customer->id, $customer)) {
                throw new \Exception(lang('Login.messageChangePasswordErro'));
            }
            $result = redirect()->with('messageInfo', lang("Login.messageChangePasswordSuccess"))->to('/CustomerLogin');

        } catch (\Exception $ex) {

            switch ($ex->getCode()) {
                case 404:
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    return;
                    break;
                case 97 :
                    $result = $result->with('erros', $validation->getErrors());
                    break;
                default:
                    $result = $result->with('erros', [$ex->getMessage()]);
                    break;

            }
            $result = $result->withInput()->to("/CustomerLogin/changePassword/{$hash}");

        }

        return $result;
    }



}
