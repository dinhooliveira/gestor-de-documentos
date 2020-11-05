<?php namespace App\Controllers\Customer;

use App\Models\CustomerModel;

class Home extends \App\Controllers\BaseController
{

    private $pearPage = 10;
    private $page = 1;
    protected $CustomerModel;
    protected $FileModel;
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->CustomerModel = new CustomerModel();
        $this->FileModel = new \App\Models\FileModel();
    }

    public function index()
    {

        $this->page = $this->request->getGet('page') ? $this->request->getGet('page') : $this->page;
        $rs = $this->CustomerModel->getFilePaginate(
            $this->request->getGet('search'),
            $this->page, $this->pearPage,
            $this->session->get('customer')->id
        );
        $data['files'] = $rs['data'];
        $pager = service('pager');

        $data['links'] = $pager->makeLinks($this->page, $this->pearPage, $rs['total']);
        return view('customer-dashboard/home',$data);
    }

    public function download($id){
        $fileRs =  $this->FileModel->find($id);
        $file_location = WRITEPATH."uploads/".$fileRs->file_location;
        $file = new \CodeIgniter\Files\File($file_location);
        header("Content-disposition: attachment; filename={$fileRs->name}.{$file->getExtension()}");
        header("Content-type: application/{$file->getExtension()}");
        if($fileRs->customer_id ==$this->session->get('customer')->id){
            readfile("{$file_location}");
        }

    }


}
