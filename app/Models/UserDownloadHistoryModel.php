<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDownloadHistoryModel extends Model{


    protected $table = 'user_download_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'file_id', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}