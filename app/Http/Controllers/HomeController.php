<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;

class HomeController extends AdminMenuController implements Database
{
    function __construct(){
        $this->modal = mydb::find(request()->session()->get('userId'));
        parent::__construct($this, 'Admin');
    }
    function getDb(){
        return $this->modal;
    }
    function MyInfo(){
        return $this->modal[$this->language];
    }
    function index(){
        return view('home',[
            'lang'=>$this
        ]);
    }
}
