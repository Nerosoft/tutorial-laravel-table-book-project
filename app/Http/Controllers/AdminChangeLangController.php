<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
class AdminChangeLangController extends ActionController implements Validation
{
    function getDb(){
        return $this->modal;
    }
    function MyInfo(){
        return $this->modal[$this->language];
    }
    function Validation(){
        array_push($this->roll['id'], Rule::notIn($this->language));
        $this->message['not_in'] = $this->MyInfo()['ChangeLanguage']['Used'];
        $setting = $this->getDb()['Setting'];
        $setting['Language'] = request()->input('id');
        $this->getDb()['Setting'] = $setting;
        request()->validate($this->roll, $this->message);
        $this->messageServer = $this->getDb()[request()->input('id')]['ChangeLanguage']['ChangeLang'].$this->getDb()[request()->input('id')]['AllNamesLanguage'][request()->input('id')];
    }
    function __construct(){
        $this->modal = mydb::find(request()->session()->get('userId'));
        parent::__construct($this, 'ChangeLanguage');
    }
    function makeChangeMyLanguage(){
        $this->getDb()->save();
        return back()->with('success', $this->messageServer);
    }
}
