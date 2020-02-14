<?php namespace App\Controllers\Admin;

class Home extends \App\Controllers\BaseController
{
    function __construct()
    {
        \Security::auth();
    }

    public function index()
	{
		return view('user-dashboard/home');
	}

}
