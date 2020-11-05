<?php namespace App\Controllers\Admin;

use App\Models\FileModel;

class File extends \App\Controllers\BaseController
{

    private $pearPage = 10;
    private $page = 1;
    protected $FileModel;
    protected $session;
    protected $customerModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->customerModel = new  \App\Models\CustomerModel();
        $this->FileModel = new FileModel();
    }

    public function index()
    {
        $data['message'] = $this->session->getFlashdata('message') ?? $this->session->getFlashdata('message');

        $this->page = $this->request->getGet('page') ? $this->request->getGet('page') : $this->page;
        $rs = $this->FileModel->getForPaginate($this->request->getGet('search'),$this->page, $this->pearPage);
        $data['files'] = $rs['data'];
        $pager = service('pager');

        $data['links'] = $pager->makeLinks($this->page, $this->pearPage, $rs['total']);
        return view('user-dashboard/file/file-grid', $data);
    }

    public function show($id=null){
        try {
            if(empty($id)){
                throw new \Exception(lang('File.messageErroFileNotFoundId'));
            }

           $file =  $this->FileModel->find($id);
            if(empty($file)){
                throw new \Exception(lang('File.messageErroFileNotFound'));
            }

            $file_location = WRITEPATH."uploads/".$file->file_location;
            $data['fileRec'] = new \CodeIgniter\Files\File($file_location);
            $data['file'] = $file;

            return view('user-dashboard/file/file-view',$data);

        }catch(\Exception $ex){
            return redirect()->with('message',$ex->getMessage())->to('/admin/file');
        }

    }

    public function create()
    {

        $data = [];
        $data['erros'] = $this->session->getFlashdata('erros') ?? $this->session->getFlashdata('erros');
        $data['customers'] = $this->customerModel->findAll();
        return view('user-dashboard/file/form-create', $data);
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->with('message', lang('File.messageErroFileNotFoundId'))->to("/admin/file");
        }
        $file = $this->FileModel->find($id);

        if (!$file) {
            return redirect()->with('message', lang('File.messageErroFileNotFound'))->to("/admin/file");
        }

        $data['erros'] = $this->session->getFlashdata('erros') ?? $this->session->getFlashdata('erros');
        $data['file'] = $file;
        $data['customers'] = $this->customerModel->findAll();

        return view('user-dashboard/file/form-edit', $data);
    }

    public function store()
    {

        helper(['url']);
        $validation = \Config\Services::validation();
        $validation->setRule('file', lang('File.fieldFile'), 'uploaded[file]|max_size[file,5000]');
        $validation->setRule('name', lang('File.fieldName'), 'required');
        $validation->setRule('customer',  lang('File.fieldCustomer'), 'required');
        try {

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            $file = $this->request->getFile('file');
            $path =  $file->store('upload_files');
            $file = new \App\Entities\File();
            $file->name = $this->request->getPost('name');
            $file->file_location = $path;
            $file->customer_id = $this->request->getPost('customer');
            $file->user_id = $this->session->get('user')->id;
            if (!$this->FileModel->save($file)) {
                throw new \Exception(lang('File.messageSaveErro'));
            }
            $message = lang('File.messageSave')."<br>";

            $result = redirect()->with('message', $message)->to('/admin/file/');

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

            $result = $result->withInput()->to('/admin/file/create');

        }

        return $result;

    }

    public function update()
    {

        helper(['url']);
        $validation = \Config\Services::validation();

        $validation->setRule('id', 'ID', 'required');
        $validation->setRule('name', lang('File.fieldName'), 'required');
        $validation->setRule('customer',  lang('File.fieldCustomer'), 'required');
        if(!empty($this->request->getFile('file')->getName())){
            $validation->setRule('file', lang('File.fieldFile'), 'uploaded[file]|max_size[file,5000]');
        }

        try {

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            if (!$this->request->getPost('id')) {
                return redirect()->with('message', lang('File.messageErroFileNotFoundId'))->to("/admin/file");
            }

            $file = $this->FileModel->find($this->request->getPost('id'));

            if (!$file) {
                return redirect()->with('message', lang('File.messageErroFileNotFound'))->to("/admin/file");
            }

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception("Validation errors", 97);
            }

            $file->name = $this->request->getPost('name');

            if(!empty($this->request->getFile('file')->getName())){
                $file_location = WRITEPATH."uploads/".$file->file_location;
                if(file_exists($file_location)){
                    chmod($file_location,0777);//permission file
                    unlink($file_location);//delete file
                }
                $file->file_location = $this->request->getFile('file')->store('upload_files');
            }

            $file->customer_id = $this->request->getPost('customer');
            $file->user_id = $this->session->get('user')->id;


            if (!$this->FileModel->update($file->id, $file)) {
                throw new \Exception("error updating file");
            }
            $message = lang('File.messageUpdated');

            $result = redirect()->with('message', $message)->to('/admin/file/');

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

            $result = $result->withInput()->to("/admin/file/edit/{$this->request->getPost("id")}");

        }

        return $result;

    }

    public function delete()
    {

    }

    public function download($id){
        $fileRs =  $this->FileModel->find($id);
        $file_location = WRITEPATH."uploads/".$fileRs->file_location;
        $file = new \CodeIgniter\Files\File($file_location);
        header("Content-disposition: attachment; filename={$fileRs->name}.{$file->getExtension()}");
        header("Content-type: application/{$file->getExtension()}");
        readfile("{$file_location}");
    }

}
