<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('homepage');
    }
    public function play($data): string
    {
        $data = $data *12;
        echo('Hello World ->' . $data);
        exit();
    }
}
