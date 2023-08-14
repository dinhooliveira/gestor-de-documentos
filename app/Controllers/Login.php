<?php
namespace App\Controllers;

use Config\Services;

class Login extends \App\Controllers\BaseController
{
    function index(){
        return view('login');
    }
}

