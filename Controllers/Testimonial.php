<?php

namespace App\Controllers;

class Testimonial extends BaseController
{
    public function f_testimonial(): string
    {
        return view('v_testimonial');
    }
}