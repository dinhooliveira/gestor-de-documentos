<?php namespace App\Controllers\Customer;

use App\Models\CustomerModel;
use App\Traits\DownloadFile;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends \App\Controllers\BaseController
{
    use DownloadFile;

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
        $customerDownloadHistory = new \App\Models\CustomerDownloadHistoryModel();
        $fileRs =  $this->FileModel->find($id);
        $file_location = WRITEPATH."uploads/".$fileRs->file_location;
        $file = new \CodeIgniter\Files\File($file_location);
        if($fileRs->customer_id == $this->session->get('customer')->id){
            $customerDownloadHistory->save([
                'file_id'=> $fileRs->id,
                'customer_id'=>$fileRs->customer_id
            ]);
            $this->downloadFile($fileRs->name,$file_location,$file->getExtension());
            exit();
        }
        
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Arquivo não encontrado!");

    }


}
