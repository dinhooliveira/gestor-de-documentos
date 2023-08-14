<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerDownloadHistoryModel extends Model{

    protected $table = 'customer_download_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'file_id', 'customer_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}