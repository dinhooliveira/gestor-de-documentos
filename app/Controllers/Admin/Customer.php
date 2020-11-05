<?php namespace App\Controllers\Admin;

use App\Models\CustomerModel;

class Customer extends \App\Controllers\BaseController
{

    private $pearPage = 10;
    private $page = 1;
    protected $CustomerModel;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->CustomerModel = new CustomerModel();
    }

    public function index()
    {
        $data['message'] = $this->session->getFlashdata('message') ?? $this->session->getFlashdata('message');

        $this->page = $this->request->getGet('page') ? $this->request->getGet('page') : $this->page;
        $rs = $this->CustomerModel->getForPaginate($this->request->getGet('search'),$this->page, $this->pearPage);
        $data['customers'] = $rs['data'];
        $pager = service('pager');

        $data['links'] = $pager->makeLinks($this->page, $this->pearPage, $rs['total']);
        return view('user-dashboard/customer/customer-grid', $data);
    }

    public function show($id=null){
        try {
            if(empty($id)){
                throw new \Exception(lang('Customer.messageErroCustomerNotFoundId'));
            }

           $customer =  $this->CustomerModel->find($id);
            if(empty($customer)){
                throw new \Exception(lang('Customer.messageErroCustomerNotFound'));
            }

            $data['customer'] = $customer;

            return view('user-dashboard/customer/customer-view',$data);


        }catch(\Exception $ex){
            return redirect()->with('message',$ex->getMessage())->to('/admin/customer');
        }

    }

    public function create()
    {

        $data = [];
        $data['erros'] = $this->session->getFlashdata('erros') ?? $this->session->getFlashdata('erros');
        return view('user-dashboard/customer/form-create', $data);
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->with('message', lang('Customer.messageErroCustomerNotFoundId'))->to("/admin/customer");
        }
        $customer = $this->CustomerModel->find($id);

        if (!$customer) {
            return redirect()->with('message', lang('Customer.messageErroCustomerNotFound'))->to("/admin/customer");
        }

        $data['erros'] = $this->session->getFlashdata('erros') ?? $this->session->getFlashdata('erros');
        $data['customer'] = $customer;


        return view('user-dashboard/customer/form-edit', $data);
    }

    public function store()
    {

        helper(['url']);
        $validation = \Config\Services::validation();

        $validation->setRule('name', lang('Customer.fieldName'), 'required');
        $validation->setRule('email', 'E-mail', 'required|valid_email|is_unique[customer.email]');
        $validation->setRule('cemail', lang('Customer.fieldConfEmail'), 'required|matches[email]');

        try {

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            helper('text');
            $password = random_string('alnum', 8);
            $customer = new \App\Entities\Customer();
            $customer->name = $this->request->getPost('name');
            $customer->email = $this->request->getPost('email');
            $customer->setPassword($password);
            if (!$this->CustomerModel->save($customer)) {
                throw new \Exception(lang('Customer.messageSaveErro'));
            }
            $message = lang('Customer.messageSave')."<br>";
            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setSubject(lang('Customer.registeredPassword'));
            $messageEmail = lang('Customer.messageEmailRegistration');
            $email->setMessage("{$messageEmail}<b>{$password}</b>");

            if (!$email->send()) {
                $message .= lang('Customer.messageEmailRegistrationErro');
            }

            $result = redirect()->with('message', $message)->to('/admin/customer/');

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

            $result = $result->withInput()->to('/admin/customer/create');

        }

        return $result;

    }

    public function update()
    {

        helper(['url']);
        $validation = \Config\Services::validation();

        $validation->setRule('id', 'ID', 'required');
        $validation->setRule('name', lang('Customer.fieldName'), 'required');
        $validation->setRule('email', 'E-mail', 'required|valid_email');
        $validation->setRule('cemail', lang('Customer.fieldConfEmail'), 'required|matches[email]');

        try {


            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            if (!$this->request->getPost('id')) {
                return redirect()->with('message', lang('Customer.messageErroCustomerNotFoundId'))->to("/admin/customer");
            }

            $customer = $this->CustomerModel->find($this->request->getPost('id'));

            if (!$customer) {
                return redirect()->with('message', lang('Customer.messageErroCustomerNotFound'))->to("/admin/customer");
            }

            if ($customer->email != $this->request->getPost('email')) {
                $validation->setRule('email', 'E-mail', 'is_unique[customer.email]');
            }

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }
            $customer->name = $this->request->getPost('name');
            $customer->email = $this->request->getPost('email');
            if (!$this->CustomerModel->update($customer->id, $customer)) {
                throw new \Exception(lang('Customer.messageUpdatedErro'));
            }
            $message = lang('Customer.messageUpdated');

            $result = redirect()->with('message', $message)->to('/admin/customer/');

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

            $result = $result->withInput()->to("/admin/customer/edit/{$this->request->getPost("id")}");

        }

        return $result;

    }

    public function delete()
    {

    }

}
