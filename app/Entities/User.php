<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Libraries\Util;

class User extends Entity
{

    public function setPassword($pass = null): User
    {
        if (empty($pass)) {
            throw new \Exception("Senha não pode ser em branco");
        }
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }

    public function clearForgotPassword(): User
    {
        $this->attributes['forgot_password'] = null;
        return $this;
    }

    public function setForgotPassword($string = null): User
    {
        if (empty($string)) {
            throw new \Exception("Esqueci a Senha não pode ser em branco");
        }
        $this->attributes['forgot_password'] = hash("SHA256", $string, false);
        return $this;
    }

    /**
     * @throws \Exception
     */
    function getCreatedAt($lang = null)
    {
        return Util::formatDate($lang, $this->attributes['created_at']);
    }

    /**
     * @throws \Exception
     */
    function getUpdatedAt($lang = null)
    {
        return Util::formatDate($lang, $this->attributes['updated_at']);
    }

}
