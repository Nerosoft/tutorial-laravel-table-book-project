<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;

class EditLanguageController extends ActionController implements Validation
{
    function Validation(){
        $this->roll['db_id']=['required', Rule::in($this->getDb()['_id']),
        function ($attribute, $value, $fail){
            if(@unserialize(request()->cookie(request()->input('db_id'))) === request()->input('id') ||
            request()->input('id') === $this->language && !request()->hasCookie(request()->input('db_id')))
                $fail($this->MyInfo()['ChangeLanguage']['ChangeLagUsed']);
        }];
        $this->message['db_id.required'] = $this->MyInfo()['ChangeLanguage']['DbIdIsReq'];
        $this->message['db_id.in'] = $this->MyInfo()['ChangeLanguage']['DbIdIsInv'];
        request()->validate($this->roll, $this->message);
        $this->messageServer = $this->getDb()[request()->input('id')]['ChangeLanguage']['SuccessMessage'].$this->getDb()[request()->input('id')]['AllNamesLanguage'][request()->input('id')];
    }
    function getDb(){
        return $this->model;
    }
    function MyInfo(){
        return $this->model[$this->language];
    }
    function __construct(){
        $this->model = mydb::find(request()->input('db_id'))??mydb::first();
        parent::__construct($this, 'ChangeLanguage');
    }

    function makeChangeLanguage(){
        Cookie::queue(request()->input('db_id'), serialize(request()->input('id')),2628000);
        return back()->with('success', $this->messageServer);
    }
}
