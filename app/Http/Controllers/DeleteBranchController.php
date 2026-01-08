<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
class DeleteBranchController extends ActionController implements Validation
{
    function getDb(){
        return $this->model;
    }
    function MyInfo(){
        return $this->model[$this->language];
    }
    function Validation(){
        $this->successfully1 = $this->MyInfo()[request()->route('id')]['Delete'];
        $arr = $this->getDb()[request()->route('id')];
        unset($arr[request()->input('id')]);
        if(empty($arr))
            unset($this->getDb()[request()->route('id')]);
        else
            $this->getDb()[request()->route('id')] = $arr;
    }
    function __construct(){
        $this->model = mydb::find(request()->session()->get('userId'));
        parent::__construct($this, request()->route('id'));
        request()->validate($this->roll, $this->message);
    }
    public function makeDeleteBranch(){
        mydb::find(request()->input('id'))->delete();
        $this->getDb()->save();
        return back()->with('success', $this->successfully1);
    }
    public function makeDeleteFlexTable(){
        $this->getDb()->save();
        return back()->with('success', $this->successfully1);
    }
}
