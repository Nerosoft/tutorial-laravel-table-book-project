<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;

class RegisterController extends LoginRegisterController implements Viewphp
{
    function __construct(){
        $this->model = mydb::find(request()->route('id'))?mydb::find(request()->route('id')):(mydb::find(request()->input('db_id'))?mydb::find(request()->input('db_id')):mydb::first());
        $this->RequiredConforemPassword = $this->getDb()[isset($this->getDb()[@unserialize(request()->cookie($this->getDb()['_id']))]) ? unserialize(request()->cookie($this->getDb()['_id'])) : $this->getDb()['Setting']['Language']]['Register']['RequiredConforemPassword'];
        $this->InvalidConforemPassword = $this->getDb()[isset($this->getDb()[@unserialize(request()->cookie($this->getDb()['_id']))]) ? unserialize(request()->cookie($this->getDb()['_id'])) : $this->getDb()['Setting']['Language']]['Register']['InvalidConforemPassword'];
        $this->Password_ConfiremInvalid = $this->getDb()[isset($this->getDb()[@unserialize(request()->cookie($this->getDb()['_id']))]) ? unserialize(request()->cookie($this->getDb()['_id'])) : $this->getDb()['Setting']['Language']]['Register']['Password_ConfiremInvalid'];
        parent::__construct($this, 'Register');
    }
    function index(){
        return $this->view;
    }
    function makeRegister(){
        $this->getDb()->save();
        request()->session()->put('userId', request()->input('db_id'));
        request()->session()->put('staticId', request()->input('db_id'));
        return redirect()->route('Home')->with('success', $this->successfully);
    }
    function Validation(){
        $arr = $this->getDb()['Users'];
        $arr[$this->generateUniqueIdentifier()] = array('Email'=>request()->input('email'), 'Password'=>request()->input('password'));
        $this->getDb()['Users'] = $arr;
        array_push($this->roll['email'], Rule::notIn(array_map(function($users) {return $users->getEmail();}, $this->users)));
        array_push($this->roll['password'], 'confirmed');
        $this->roll['password_confirmation'] = ['required', 'min:8'];
        $this->message['email.not_in'] = $this->MyInfo()['Register']['UserEmailExist'];
        $this->message['password_confirmation.min'] = $this->InvalidConforemPassword;
        $this->message['password_confirmation.required'] = $this->RequiredConforemPassword;
        $this->message['password.confirmed'] = $this->Password_ConfiremInvalid;
        request()->validate($this->roll, $this->message);
    }
    function MyInfo(){
        return $this->model[$this->language];
    }
    function getDb(){
        return $this->model;
    }
    function setupView(){
        $this->LabelPasswordConfirem = $this->MyInfo()['Register']['LabelPasswordConfirem'];
        $this->HintPasswordConfirem = $this->MyInfo()['Register']['HintPasswordConfirem'];
        $this->view = view('register', [
            'lang'=>$this,
            'action'=>route('makeRegister')
        ]);
    }
}
