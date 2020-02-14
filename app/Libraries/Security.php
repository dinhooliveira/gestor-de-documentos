<?php

class Security
{
    static function auth(){

        $session = \Config\Services::session();
        if(!$session->has('user')){
            header("Location:".base_url('UserLogin')."");
            exit();
        }
    }

    static function customerAuth(){
        $session = \Config\Services::session();
        if(!$session->has('customer')){
            header("Location:".base_url('CustomerLogin')."");
            exit();
        }
    }
}
