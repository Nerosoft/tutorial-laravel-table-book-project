<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mydb;
class MainBranchController extends ActionController implements Validation
{
function getDb(){
        return $this->model;
    }
    function MyInfo(){
        return $this->model[$this->language];
    }
    function Validation(){
        request()->validate($this->roll, $this->message);
        $this->successfulyMessage = mydb::find(request()->input('id'))[mydb::find(request()->input('id'))['Setting']['Language']]['Branches']['BranchesChange'].' '.$this->getDb()['Branches'][request()->input('id')]['Name'];
        request()->session()->put('userId', request()->input('id'));
    }
    function __construct(){
        if(request()->session()->get('staticId') === request()->input('id') && request()->input('id') === request()->session()->get('userId')){
            $this->model = mydb::find(request()->session()->get('userId'));
            parent::__construct($this);
            $this->successfulyMessage = $this->MyInfo()['Branches']['BranchesChange'].' '.$this->MyInfo()['AppSettingAdmin']['BranchMain'];
        }else if(request()->session()->get('staticId') === request()->input('id')){
            $this->model = mydb::find(request()->input('id'));
            parent::__construct($this);
            $this->successfulyMessage = $this->MyInfo()['Branches']['BranchesChange'].' '.$this->MyInfo()['AppSettingAdmin']['BranchMain'];
            request()->session()->put('userId', request()->input('id'));
        }else{
            $this->model = mydb::find(request()->session()->get('userId'));
            parent::__construct($this, 'Branches');
        }
    }
    function makeChangeBranch(){
        return back()->with('success', $this->successfulyMessage);
    }
}
