<?php

namespace App\Controllers;

class About extends BaseController
{
    public function f_about(): string
    {
        return view('v_about');
    }
}
