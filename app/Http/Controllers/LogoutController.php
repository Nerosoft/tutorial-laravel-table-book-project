<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;

class LogoutController extends Controller
{
    function __construct(){

    }
    function logout(){
        $url = mydb::first()['_id'] === request()->session()->get('staticId') ? redirect()->route('mylogin'):redirect('/login/'.request()->session()->get('staticId'));
        request()->session()->forget('userId');
        request()->session()->forget('staticId');
        return $url;
    }
}
