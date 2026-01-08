<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
class DeleteLangController extends ActionController implements Validation
{
    function getDb(){
        return $this->modal;
    }
    function MyInfo(){
        return $this->modal[$this->language];
    }
    function Validation(){
        array_push($this->roll['id'], Rule::notIn($this->language));
        $this->messageServer = $this->MyInfo()['ChangeLanguage']['DeleteLanguage'];
        $this->message['not_in'] = $this->MyInfo()['ChangeLanguage']['Used'];
        foreach ($this->MyInfo()['AllNamesLanguage'] as $key=>$value) {
            if($key !== request()->input('id')){
                $myLang = $this->getDb()[$key];
                unset($myLang['AllNamesLanguage'][request()->input('id')]);
                $this->getDb()[$key] = $myLang;
            }
        }
        unset($this->getDb()[request()->input('id')]);
    }
    function __construct(){
        $this->modal = mydb::find(request()->session()->get('userId'));
        parent::__construct($this, 'ChangeLanguage');
        request()->validate($this->roll, $this->message);
    }
    function makeDeleteMyLanguage(){
        $this->getDb()->save();
        return back()->with('success', $this->messageServer);
    }
}
