<?php

namespace App\Controllers;

use App\Models\Member;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        return view('homepage');
    }

    public function login(): string
    {
        $rules=[
            'username'=>'requiredvalid_email',
            'password'=>'required'
        ];

        if(!$this->validate($rules)){
            $data = array('load_error' => 'true');
            helper('form');
            return view('homepage', $data);
        }else {

            $Member = new Member();
            if ($Member->user_login($this->request->getPost('username'), $this->request->getPost('password'))) {
                return view('admin_page');
            } else {
            $data = array('load_error' => 'true', 'error_message' => 'Invalid username or password');
            helper('form');
            return view('homepage', $data);
            }
        }

    }

    public function create(): string
    {
        $rules = [
            'fullname' => 'required',
            'email'    => 'required|valid_email',
            'password' => 'required',
            'confirm_password' => 'required|matches[password]'
        ];

        if (! $this->validate($rules)) {
            $data = array('load_error' => 'true');

            helper('form');
            return view('admin', $data);

        }else {
            $Member = new Member();

            $Member->create_user($this->request->getPost('fullname'),
                $this->request->getPost('email'),
                $this->request->getPost('password'));

            $data = array('success_message' => 'User has been created');

            helper('form');

            return view('admin', $data);
        }
    }


    public function play($data): string
    {
        $data = $data *12;
        echo('Hello World ->' . $data);
        exit();
    }
}
