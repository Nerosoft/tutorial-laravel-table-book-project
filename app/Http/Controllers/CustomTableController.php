<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
class CustomTableController extends ActionController implements DisplayData
{
    function __construct(){
        $this->model = mydb::find(request()->session()->get('userId'));
        $this->error1 = $this->getDb()[$this->getDb()['Setting']['Language']]['CustomTable']['NameTableIsReq'];
        $this->error2 = $this->getDb()[$this->getDb()['Setting']['Language']]['CustomTable']['NameTableIsInv'];
        $this->error3 = $this->getDb()[$this->getDb()['Setting']['Language']]['CustomTable']['InputNumberTableIsReq'];
        $this->error4 = $this->getDb()[$this->getDb()['Setting']['Language']]['CustomTable']['InputNumberTableIsInv'];
        parent::__construct($this, 'CustomTable');
    }
    function index(){
        return view('custom_table',[
            'lang'=> $this,
        ]);
    }
    public function getDataTable(){
        return isset($this->MyInfo()['MyFlexTables'])?array_reverse(CustomTable::fromArray($this->MyInfo()['MyFlexTables'])):array();
    }
    function Validation(){
        $this->roll['name'] = ['required', 'min:3'];
        $this->message['name.required'] = $this->error1;
        $this->message['name.min'] = $this->error2;
        if(Route::currentRouteName() === 'addTable'){
            $this->roll['input_number'] = ['required', 'integer', 'between:1,8'];
            $this->message['input_number.required'] =  $this->error3;
            $this->message['input_number.integer'] =  $this->error4;
            $this->message['input_number.between'] =  $this->error4;
        }else
            $this->successfulyMessage = $this->MyInfo()['CustomTable']['MessageModelEdit'];
        request()->validate($this->roll, $this->message);

    }
    function MyInfo(){
          return $this->model[$this->language];
    }
    function getDb(){
        return $this->model;
    }
    function setupView(){
        $this->TableName = $this->MyInfo()['CustomTable']['NameTable'];
        $this->LabelName = $this->MyInfo()['CustomTable']['LabelName'];
        $this->HintName = $this->MyInfo()['CustomTable']['HintName'];
        $this->LabelInputNumber = $this->MyInfo()['CustomTable']['LabelInputNumber'];
        $this->HintInputNumber = $this->MyInfo()['CustomTable']['HintInputNumber'];
    }
    function makeAddTable(){
        $key = $this->generateUniqueIdentifier();
        foreach ($this->MyInfo()['AllNamesLanguage'] as $code => $value) {
            $lang = $this->getDb()[$code];
            $lang['MyFlexTables'][$key] = request()->input('name');
            $lang[$key] = $lang['TablePage'];
            $lang[$key]['MYTITLE'] = request()->input('name');
            for ($i=0; $i < request()->input('input_number'); $i++){
                $myInputKey = $this->generateUniqueIdentifier();
                $lang[$key]['TableHead'][$myInputKey] = $lang['AppSettingAdmin']['InputNameTable'];
                $lang[$key]['Label'][$myInputKey] = $lang['AppSettingAdmin']['InputLabel'];
                $lang[$key]['Hint'][$myInputKey] = $lang['AppSettingAdmin']['InputHint'];
                $lang[$key]['ErrorsMessageReq'][$myInputKey] = $lang['AppSettingAdmin']['InputErrorsMessageReq'];
                $lang[$key]['ErrorsMessageInv'][$myInputKey] = $lang['AppSettingAdmin']['InputErrorsMessageInv'];
            }
            $this->getDb()[$code] = $lang;
        }
        $this->getDb()->save();
        return back()->with('success', $this->successfulyMessage);
    }
    function makeEditTable(){
        foreach ($this->MyInfo()['AllNamesLanguage'] as $key => $value) {
            $lang = $this->getDb()[$key];
            $lang['MyFlexTables'][request()->input('id')] = request()->input('name');
            $this->getDb()[$key] = $lang;
        }
        $this->getDb()->save();
        return back()->with('success', $this->successfulyMessage);
    }
}
