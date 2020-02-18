<?php
namespace App\Models;
class UserModel extends \CodeIgniter\Model
{

    protected $table      = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email','password','forgot_password'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType    = 'App\Entities\User';

    public function getForPaginate($search='',$page = 1, $perpage = 10){
        $offset = ($page - 1) * $perpage;
        $sql = "
           SELECT 
           SQL_CALC_FOUND_ROWS
           *
           FROM
              {$this->table}
           WHERE
              name like '%{$search}%'
            OR email like '%{$search}%'
            ORDER BY {$this->table}.id DESC
            LIMIT {$perpage} 
            OFFSET {$offset}
         ";
        $rs = $this->db->query($sql);
        $data['data'] = $rs->getResult();
        $data["total"] = $this->db->query("SELECT FOUND_ROWS() as total")->getFirstRow()->total;
        return $data;
    }
}
