<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function user()
    {
        return view('userdashboard');
    }

    public function admin()
    {
        return view('admindashboard');
    }
}
