<?php

namespace App\Controllers;

class DashbordController extends BaseController
{
    public function index(): string
    {
        return view('main\dashboard\index');
    }
}
