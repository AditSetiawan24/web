<?php

namespace App\Controllers;

class Feature extends BaseController
{
    public function f_feature(): string
    {
        return view('v_feature');
    }
}
