<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
class ChangeLanguageController extends ActionController implements DisplayData
{
    function __construct(){
        $this->modal = mydb::find(request()->session()->get('userId'));
        $this->error1 = $this->getDb()[$this->getDb()['Setting']['Language']]['ChangeLanguage']['NewLangNameRequired'];
        $this->error2 = $this->getDb()[$this->getDb()['Setting']['Language']]['ChangeLanguage']['NewLangNameInvalid'];
        $this->allNames = $this->getDb()[$this->getDb()['Setting']['Language']]['AllNamesLanguage'];
        parent::__construct($this, 'ChangeLanguage');
    }
    function index(){
        return $this->view;
    }
    function getDataTable(){
        return MyLanguage::fromArray(array_reverse($this->allNames));
    }
    function getDb(){
        return $this->modal;
    }
    function MyInfo(){
        return $this->modal[$this->language];
    }
    function setupView(){
        $this->NameLangaue = $this->MyInfo()['ChangeLanguage']['NameLangaue'];
        $this->label3 = $this->MyInfo()['ChangeLanguage']['LanguageInfo'];     
        $this->label4 = $this->MyInfo()['ChangeLanguage']['LanguageSelect'];
        $this->label5 = $this->MyInfo()['ChangeLanguage']['LabelChangeLanguageMessage'];
        $this->LabelNameLanguage = $this->MyInfo()['ChangeLanguage']['LabelCreateLanguage'];
        $this->label7 = $this->MyInfo()['ChangeLanguage']['LabelNewLangName'];
        $this->hint1 = $this->MyInfo()['ChangeLanguage']['HintNewLangName'];
        $this->button4 = $this->MyInfo()['ChangeLanguage']['ButtonChangeLanguageMessage'];
        $this->TitleChangeLanguageMessage = $this->MyInfo()['ChangeLanguage']['TitleChangeLanguageMessage'];
        $this->view = view('change_language', [
            'lang'=>$this,
        ]);
    }
    function Validation(){
        $this->roll['lang_name'] = ['required', 'min:3'];
        $this->message['lang_name.required'] = $this->error1;
        $this->message['lang_name.min'] = $this->error2;
        if(Route::currentRouteName() === 'lang.createLanguage'){
            $this->newKey = $this->generateUniqueIdentifier();
            foreach ($this->allNames as $key=>$value) {
                $myLang = $this->getDb()[$key];
                $myLang['AllNamesLanguage'][$this->newKey] = request()->input('lang_name');
                $this->getDb()[$key] = $myLang;
            }
        }else{
            $this->successfulyMessage = $this->MyInfo()['ChangeLanguage']['MessageModelEdit'];
            foreach ($this->allNames as $key=>$value) {
                $myLang = $this->getDb()[$key];
                $myLang['AllNamesLanguage'][request()->input('id')] = request()->input('lang_name');
                $this->getDb()[$key] = $myLang;
            }
        }
        request()->validate($this->roll, $this->message);
    }
    function makeAddLanguage(){
        $myLanguage = $this->getDb()['MyLanguage'];
        $myLanguage['AllNamesLanguage'] = $this->MyInfo()['AllNamesLanguage'];
        if(isset($this->MyInfo()['MyFlexTables']))
            foreach ($this->MyInfo()['MyFlexTables'] as $key => $value){ 
                $myLanguage['MyFlexTables'][$key] = $value;
                $myLanguage[$key] = $this->MyInfo()[$key];   
            } 
        $this->getDb()[$this->newKey] = $myLanguage;
        return $this->makeEditLanguage();
    }
    function makeEditLanguage(){
        $this->getDb()->save();
        return back()->with('success', $this->successfulyMessage);
    }
}
