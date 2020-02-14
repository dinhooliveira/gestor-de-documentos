<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Customer extends Entity
{

    public function setPassword($pass)
    {
        if(!$pass){
            throw new \Exception("Senha não pode ser em branco");
        }
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }

    function getCreatedAt($lang=null){
        return  \Util::formatDate($lang,$this->attributes['created_at']);
    }

    function getUpdatedAt($lang=null){
        return   \Util::formatDate($lang,$this->attributes['updated_at']);
    }
}
