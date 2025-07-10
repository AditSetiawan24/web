<?php

namespace App\Controllers;

class Services extends BaseController
{
    public function f_services(): string
    {
        return view('v_services');
    }
}