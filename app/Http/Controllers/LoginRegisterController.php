<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class LoginRegisterController extends InformationPageController
{
    function __construct(Viewphp $obj, $keyPage){
        $lang = isset($obj->getDb()[@unserialize(request()->cookie($obj->getDb()['_id']))]) ? unserialize(request()->cookie($obj->getDb()['_id'])) : $obj->getDb()['Setting']['Language'];
        $this->RequiredEmail = $obj->getDb()[$lang][$keyPage]['RequiredEmail'];
        $this->InvalidEmail = $obj->getDb()[$lang][$keyPage]['InvalidEmail'];
        $this->RequiredPassword = $obj->getDb()[$lang][$keyPage]['RequiredPassword'];
        $this->InvalidPassword = $obj->getDb()[$lang][$keyPage]['InvalidPassword'];
        if(Route::currentRouteName() === 'makeLogin' || Route::currentRouteName() === 'makeRegister'){
            parent::__construct($lang);
            $this->roll = [
                    'db_id'=>['required', Rule::in($obj->getDb()['_id'])],
                    'email'=>['required', 'email'],
                    'password'=>['required', 'min:8']
                ];
                $this->message = [
                    'db_id.required'=>$obj->MyInfo()[$keyPage]['DdIdReq'],
                    'db_id.in'=>$obj->MyInfo()[$keyPage]['DdIdInv'],
                    'email.required'=>$this->RequiredEmail,
                    'email.email'=>$this->InvalidEmail,
                    'password.required'=>$this->RequiredPassword,
                    'password.min'=>$this->InvalidPassword,
                ];
                $this->users = isset($obj->getDb()['Users']) ? Users::fromArray($obj->getDb()['Users']) : array();
                $this->successfully = $obj->MyInfo()[$keyPage]['LoginRegisterMessage'];
                $obj->Validation();
        }else{
            parent::__construct($lang, $obj, $keyPage);
            $obj->setupView();
            $this->myId = $this->getDb()['_id'];
            $this->ButtonRegisterLogin = $obj->MyInfo()[$keyPage]['Button'];
            $this->TitleForm = $obj->MyInfo()[$keyPage]['TitleForm'];
            $this->LabelEmail = $obj->MyInfo()[$keyPage]['LabelEmail'];
            $this->HintEmail = $obj->MyInfo()[$keyPage]['HintEmail'];
            $this->LabelPassword = $obj->MyInfo()[$keyPage]['LabelPassword'];
            $this->HintPassword = $obj->MyInfo()[$keyPage]['HintPassword'];
            $this->ButtonChangeLang = $obj->MyInfo()[$keyPage]['ButtonChangeLang'];
            $this->TitleChangeLang = $obj->MyInfo()[$keyPage]['ButtonChangeLang'];
            $this->SaveChangeLang = $obj->MyInfo()[$keyPage]['SaveChangeLang'];
            $this->myRadios = MyLanguage::fromArray($obj->MyInfo()['AllNamesLanguage']);
            $this->ChangeLagUsed = $obj->MyInfo()[$keyPage]['ChangeLagUsed'];
        }
    }
}
