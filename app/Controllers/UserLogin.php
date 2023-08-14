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
        $data['linkForgotPassword'] = base_url('UserLogin/forgotPassword');
        $data["message"] = $this->session->getFlashdata("message") ?? $this->session->getFlashdata("message");
        $data["messageInfo"] = $this->session->getFlashdata("messageInfo") ?? $this->session->getFlashdata("messageInfo");
        return view('user-login', $data);
    }

    public function login()
    {
        try {

            $user = $this->UserModel->where('email', $this->request->getPost('email'))->first();
            if (!$user) {
                throw new \Exception(lang('Login.messageEmailNotFound'));
            }
            if (!password_verify($this->request->getPost('password'), $user->password)) {
                throw new \Exception(lang('Login.messagePasswordErro'));
            }
            $this->session->set('user', $user);
            return redirect()->to('/admin/home');

        } catch (\Exception $ex) {
            return redirect()->with('message', $ex->getMessage())->withInput()->to('/UserLogin');
        }


    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/UserLogin');
    }

    public function forgotPassword()
    {
        $data['urlForgotPasswordAction'] = base_url('UserLogin/sendEmailForgotPassword');
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


            $user = $this->UserModel->where(['email' => $this->request->getPost('email')])->first();
            if (empty($user)) {
                throw new \Exception(lang('Login.messageEmailNotFound'));
            }

            $forgot_password = random_string('alnum', 8);
            $user = $user->setForgotPassword($forgot_password);
            if (!$this->UserModel->update($user->id, $user)) {
                throw new \Exception(lang('Login.messageChangePasswordErro'));
            }

            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setSubject(lang('Login.textEmailMessage'));
            $textLinkChangePassword = lang('Login.linkEmailText');
            $linkChangePassword = base_url("UserLogin/changePassword/{$user->forgot_password}");
            $email->setMessage("<b> <a href='{$linkChangePassword}'>{$textLinkChangePassword}</a> </b>");

            $message = lang('Login.messageChangePassword') . "<br>";
            if (!$email->send()) {
                $message = lang('Login.messageChangePasswordEmailErro');
            }

            $result->with('messageInfo', $message)->to('/UserLogin');

        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case 97 :
                    $result = $result->with('erros', $validation->getErrors());
                    break;
                default:
                    $result = $result->with('erros', [$ex->getMessage()]);
                    break;

            }
            $result = $result->withInput()->to('/UserLogin/forgotPassword');
        }

        return $result;


    }

    public function changePassword($hash = null)
    {
        if (empty($hash)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $user = $this->UserModel->where('forgot_password', $hash)->first();
        if (empty($user)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['user'] = $user;
        $data['urlChangePasswordAction'] = base_url("/UserLogin/changePasswordAction/{$hash}");
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

            $user = $this->UserModel->where('forgot_password', $hash)->first();
            if (empty($user)) {
                throw new \Exception(null, 404);
            }
            $user = $user->setPassword($this->request->getPost('password'));
            $user = $user->clearForgotPassword();

            if (!$this->UserModel->update($user->id, $user)) {
                throw new \Exception(lang('Login.messageChangePasswordErro'));
            }
            $result = redirect()->with('messageInfo', lang("Login.messageChangePasswordSuccess"))->to('/UserLogin');

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
            $result = $result->withInput()->to("/UserLogin/changePassword/{$hash}");

        }

        return $result;
    }


}
