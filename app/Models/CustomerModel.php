<?php
namespace App\Models;
class CustomerModel extends \CodeIgniter\Model
{

    protected $table      = 'customer';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email','password'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType    = 'App\Entities\Customer';

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

    public function getFilePaginate($search = '', $page = 1, $perpage = 10,$id=null)
    {
        $offset = ($page - 1) * $perpage;
        $sql = "
           SELECT 
                SQL_CALC_FOUND_ROWS
                file.*,
                customer.name as customer,
                user.name as user
           FROM
              file
           JOIN customer ON customer.id = file.customer_id
           JOIN user ON user.id = file.user_id
           WHERE
               file.name like '%{$search}%'
            AND customer.id = {$id}
            ORDER BY file.id DESC
            LIMIT {$perpage} 
            OFFSET {$offset}
         ";
        $rs = $this->db->query($sql);
        $data['data'] = $rs->getResult();
        $data["total"] = $this->db->query("SELECT FOUND_ROWS() as total")->getFirstRow()->total;
        return $data;
    }
}
