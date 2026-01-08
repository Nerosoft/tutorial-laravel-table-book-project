<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
class SystemLangController extends TableInformationController implements DisplayData
{
    function __construct(){
        $this->modal = mydb::find(request()->session()->get('userId'));
        parent::__construct($this, Route::currentRouteName() === 'edit.editAllLanguage' ? null : 'SystemLang');
        $this->error1 = $this->MyInfo()['SystemLang']['TextRequired'];
        $this->error2 = $this->MyInfo()['SystemLang']['TextLenght'];
    }
    function index(){
        return view('all_language', [
            'lang'=> $this,
        ]);
    }
    public function getDataTable(){
        if(isset($this->getDb()[request()->route('lang')][request()->route('id')]))
            return $this->getDb()[request()->route('lang')][request()->route('id')];
        else if(is_null(request()->route('lang')) && is_null(request()->route('id'))){
            $tableData = array();
            foreach ($this->MyInfo()['AllNamesLanguage'] as $key=>$value)
                $tableData[$key] = $this->getDb()[$key];
            return $tableData;
        }
        else
            return array();
    }
    function setupView(){
        $this->Left = $this->MyInfo()['SystemLang']['ltr'];
        $this->Right = $this->MyInfo()['SystemLang']['rtl'];
        $this->label3 = $this->MyInfo()['SystemLang']['Text'];
        $this->label4 = $this->MyInfo()['SystemLang']['DirectionPage']; 
        $this->LanguageValue = $this->MyInfo()['SystemLang']['LanguageValue'];
        $this->table10 = $this->MyInfo()['SystemLang']['LanguageName'];
        $this->model2 = $this->MyInfo()['SystemLang']['TitleDirection'];
        $this->button2 = $this->MyInfo()['SystemLang']['SaveDirection'];
        $this->WordHint = $this->MyInfo()['SystemLang']['WordHint'];
    }
    function Validation(){
        $this->roll = [
            'id'=>['required', Rule::in(array_keys($this->MyInfo()))],
        ];
        $this->message = [
            'id.required'=>$this->MyInfo()['SystemLang']['EditTableRequired'],
            'id.in'=>$this->MyInfo()['SystemLang']['EditTableInvalid'],
        ];
        $this->roll['word' ] = ['required', request()->route('id') !== 'Html' ? 'min:2' : Rule::in(['ltr', 'rtl'])];
        $this->roll['myLang'] = ['required', Rule::in(array_keys($this->MyInfo()['AllNamesLanguage']))];
        $this->roll['name'] = ['required', function ($attribute, $value, $fail){
            if(request()->route('item') !== null && !isset($this->getDb()[request()->route('lang')][request()->route('id')][request()->route('name')][request()->route('item')])){
                $fail($this->MyInfo()['SystemLang']['EditKeyInvalid']);
                $fail($this->MyInfo()['SystemLang']['EditKey2Invalid']);
            }else if(!isset($this->getDb()[request()->route('lang')][request()->route('id')][request()->route('name')]))
                $fail($this->MyInfo()['SystemLang']['EditKeyInvalid']);
        }];
        $this->message['word.required'] = $this->error1;
        $this->message['word.'.(request()->route('id') !== 'Html' ?'min':'in')] = $this->error2;
        $this->message['myLang.required'] = $this->MyInfo()['SystemLang']['EditLanguageRequired'];
        $this->message['myLang.in'] = $this->MyInfo()['SystemLang']['EditLanguageInvalid'];
        $this->message['id.required'] = $this->MyInfo()['SystemLang']['EditTableRequired'];
        $this->message['id.in'] = $this->MyInfo()['SystemLang']['EditTableInvalid'];
        $this->message['name.required'] = $this->MyInfo()['SystemLang']['EditKeyRequired'];
        $this->successfulyMessage = $this->MyInfo()['SystemLang']['AllLanguageEdit'];
    }
    function makeEditLanguage($lang, $id, $name, $item = null){
        $this->Validation();
        Validator::make([...request()->all(), 'myLang'=>$lang, 'id'=>$id, 'name'=>$name, 'item'=>$item], $this->roll, $this->message)->validate();
        $var1 = $this->getDb()[$lang];
        if($item === null)
            $var1[$id][$name] = request()->input('word');
        else
            $var1[$id][$name][$item] = request()->input('word');
        $this->getDb()[$lang] = $var1;
        $this->getDb()->save();
        return back()->with('success', $this->successfulyMessage);
    }
    function getDb(){
        return $this->modal;
    }
    function MyInfo(){
        return $this->modal[$this->language];
    }
}
