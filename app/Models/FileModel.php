<?php

namespace App\Models;
class FileModel extends \CodeIgniter\Model
{

    protected $table = 'file';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'file_location', 'customer_id', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'App\Entities\File';

    public function getForPaginate($search = '', $page = 1, $perpage = 10)
    {
        $offset = ($page - 1) * $perpage;
        $sql = "
           SELECT 
                SQL_CALC_FOUND_ROWS
                {$this->table}.*,
                customer.name as customer,
                user.name as user
           FROM
              {$this->table}
           JOIN customer ON customer.id = {$this->table}.customer_id
           JOIN user ON user.id = {$this->table}.user_id
           WHERE
               {$this->table}.name like '%{$search}%'
            OR customer.name like '%{$search}%'
            OR user.name like '%{$search}%'
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
