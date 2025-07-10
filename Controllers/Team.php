<?php

namespace App\Controllers;

class Team extends BaseController
{
    public function f_team(): string
    {
        return view('v_team');
    }
}