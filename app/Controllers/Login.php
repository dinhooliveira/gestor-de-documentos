<?php
namespace App\Controllers;

use Config\Services;

class Login extends \App\Controllers\BaseController
{
    function index(){
        return "<a href=".base_url('UserLogin').">Usuário</a><a href=".base_url('CustomerLogin').">Cliente</a>";
    }
}

