<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('base_index');
    }

    public function starter()
    {
        return view('blank');
    }
}
