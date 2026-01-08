<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
class LoginController extends LoginRegisterController implements Viewphp
{
    function __construct(){
        $this->model = mydb::find(request()->route('id'))?mydb::find(request()->route('id')):(mydb::find(request()->input('db_id'))?mydb::find(request()->input('db_id')):mydb::first());
        parent::__construct($this, 'Login');
    }
    function index(){
        return $this->view;
    }
    function makeLogin(){
        if(!empty($this->users))
            foreach ($this->users as $key => $user) 
                if($user->getEmail() === request()->input('email') && $user->getPassword() === request()->input('password')){
                    request()->session()->put('userId', request()->input('db_id'));
                    request()->session()->put('staticId', request()->input('db_id'));
                    return redirect()->route('Home')->with('success', $this->successfully);
                }
        return back()->withInput()->withErrors($this->errorEamilPassword);

    }
    function Validation(){
        $this->errorEamilPassword = $this->MyInfo()['Login']['EmailPassword'];
        request()->validate($this->roll, $this->message);
    }
    function MyInfo(){
        return $this->model[$this->language];
    }
    function getDb(){
        return $this->model;
    }
    function setupView(){
        $this->view = view('login', [
            'lang'=>$this,
            'action'=>route('makeLogin')
        ]);
    }
}
