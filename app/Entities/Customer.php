<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Libraries\Util;
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

    public function clearForgotPassword(){
        $this->attributes['forgot_password'] = null;
        return $this;
    }

    public function setForgotPassword($string=null){
        if(empty($string)){
            throw new \Exception("Esqueci a Senha não pode ser em branco");
        }
        $this->attributes['forgot_password'] = hash("SHA256",$string, false);
        return $this;
    }

    function getCreatedAt($lang=null){
        return  Util::formatDate($lang,$this->attributes['created_at']);
    }

    function getUpdatedAt($lang=null){
        return   Util::formatDate($lang,$this->attributes['updated_at']);
    }
}
