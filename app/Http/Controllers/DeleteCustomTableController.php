<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
class DeleteCustomTableController extends ActionController implements Validation
{
    function getDb(){
        return $this->modal;
    }
    function MyInfo(){
        return $this->modal[$this->language];
    }
    function Validation(){
        request()->validate($this->roll, $this->message);
        foreach ($this->MyInfo()['AllNamesLanguage'] as $key => $value) {
            $lang = $this->getDb()[$key];
            if(count($lang['MyFlexTables']) === 1)
                unset($lang[request()->input('id')], $lang['MyFlexTables']);
            else
                unset($lang[request()->input('id')], $lang['MyFlexTables'][request()->input('id')]);
            $this->getDb()[$key] = $lang;
        }
        if(isset($this->getDb()[request()->input('id')]))
            unset($this->getDb()[request()->input('id')]);
        $this->successfully1 = $this->MyInfo()['CustomTable']['Delete'];
    }
    function __construct(){
        $this->modal = mydb::find(request()->session()->get('userId'));
        parent::__construct($this, 'CustomTable');

    }
    function makeDeleteTable(){
        $this->getDb()->save();
        return back()->with('success', $this->successfully1);
    }
}
