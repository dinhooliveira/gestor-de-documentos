<?php namespace App\Controllers\Admin;

use App\Models\UserModel;

class User extends \App\Controllers\BaseController
{

    private $pearPage = 10;
    private $page = 1;
    protected $UserModel;
    protected $session;

    public function __construct()
    {
        \Security::auth();
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data['message'] = $this->session->getFlashdata('message') ?? $this->session->getFlashdata('message');

        $this->page = $this->request->getGet('page') ? $this->request->getGet('page') : $this->page;
        $rs = $this->UserModel->getForPaginate($this->request->getGet('search'),$this->page, $this->pearPage);
        $data['users'] = $rs['data'];
        $pager = service('pager');

        $data['links'] = $pager->makeLinks($this->page, $this->pearPage, $rs['total']);
        return view('user-dashboard/user/user-grid', $data);
    }

    public function show($id=null){

        try {
            if(empty($id)){
                throw new \Exception(lang('User.messageErroUserNotFoundId'));
            }

           $user =  $this->UserModel->find($id);
            if(empty($user)){
                throw new \Exception(lang('User.messageErroUserNotFound'));
            }

            $data['user'] = $user;

            return view('user-dashboard/user/user-view',$data);


        }catch(\Exception $ex){
            return redirect()->with('message',$ex->getMessage())->to('/admin/user');
        }

    }

    public function create()
    {

        $data = [];
        $data['erros'] = $this->session->getFlashdata('erros') ?? $this->session->getFlashdata('erros');
        return view('user-dashboard/user/form-create', $data);
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->with('message', lang('User.messageErroUserNotFoundId'))->to("/admin/user");
        }
        $user = $this->UserModel->find($id);

        if (!$user) {
            return redirect()->with('message', lang('User.messageErroUserNotFound'))->to("/admin/user");
        }

        $data['erros'] = $this->session->getFlashdata('erros') ?? $this->session->getFlashdata('erros');
        $data['user'] = $user;


        return view('user-dashboard/user/form-edit', $data);
    }

    public function store()
    {

        helper(['url']);
        $validation = \Config\Services::validation();

        $validation->setRule('name', lang('User.fieldName'), 'required');
        $validation->setRule('email', 'E-mail', 'required|valid_email|is_unique[user.email]');
        $validation->setRule('cemail', lang('User.fieldConfEmail'), 'required|matches[email]');

        try {

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            helper('text');
            $password = random_string('alnum', 8);
            $user = new \App\Entities\User();
            $user->name = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            $user->setPassword($password);
            if (!$this->UserModel->save($user)) {
                throw new \Exception("error when registering user");
            }
            $message = lang('User.messageSave')."<br>";
            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setSubject(lang('User.registeredPassword'));
            $messageEmail = lang('User.messageEmailRegistration');
            $email->setMessage("{$messageEmail}<b>{$password}</b>");

            if (!$email->send()) {
                $message .= lang('User.messageEmailRegistrationErro');
            }

            $result = redirect()->with('message', $message)->to('/admin/user/');

        } catch (\Exception $ex) {
            $result = redirect();
            switch ($ex->getCode()) {
                case 97 :
                    $result = $result->with('erros', $validation->getErrors());
                    break;
                default:
                    $result = $result->with('erros', [$ex->getMessage()]);
                    break;

            }

            $result = $result->withInput()->to('/admin//user/create');

        }

        return $result;

    }

    public function update()
    {

        helper(['url']);
        $validation = \Config\Services::validation();

        $validation->setRule('id', 'ID', 'required');
        $validation->setRule('name', lang('User.fieldName'), 'required');
        $validation->setRule('email', 'E-mail', 'required|valid_email');
        $validation->setRule('cemail', lang('User.fieldConfEmail'), 'required|matches[email]');

        try {


            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            if (!$this->request->getPost('id')) {
                return redirect()->with('message', lang('User.messageErroUserNotFoundId'))->to("/admin/user");
            }

            $user = $this->UserModel->find($this->request->getPost('id'));

            if (!$user) {
                return redirect()->with('message', lang('User.messageErroUserNotFound'))->to("/admin/user");
            }

            if ($user->email != $this->request->getPost('email')) {
                $validation->setRule('email', 'E-mail', 'is_unique[user.email]');
            }

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }
            $user->name = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            if (!$this->UserModel->update($user->id, $user)) {
                throw new \Exception("error updating user");
            }
            $message = lang('User.messageUpdated');

            $result = redirect()->with('message', $message)->to('/admin/user/');

        } catch (\Exception $ex) {
            $result = redirect();
            switch ($ex->getCode()) {
                case 97 :
                    $result = $result->with('erros', $validation->getErrors());
                    break;
                default:
                    $result = $result->with('erros', [$ex->getMessage()]);
                    break;

            }

            $result = $result->withInput()->to("/admin/user/edit/{$this->request->getPost("id")}");

        }

        return $result;

    }

    public function delete()
    {

    }

}
