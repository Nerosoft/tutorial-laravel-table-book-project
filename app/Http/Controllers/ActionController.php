<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use App\Models\mydb;
class ActionController extends TableInformationController
{
    function __construct(Validation | Viewphp $obj, $keyPage = null){
        if(is_null($keyPage))
            parent::__construct($obj);
        else if(Route::currentRouteName() === 'branchMain' || Route::currentRouteName() === 'branch.delete' && request()->session()->get('staticId') !== request()->session()->get('userId')){
            parent::__construct($obj);
            $this->message = [
                'id.required'=>$obj->MyInfo()[$keyPage]['IdIsReq'],
                'id.in'=>$obj->MyInfo()[$keyPage]['IdIsInv'],
                'not_in'=> $obj->MyInfo()[$keyPage]['Used']
            ];
            $obj->model = mydb::find(request()->session()->get('staticId'));
            $this->roll = [
                'id'=>['required', Rule::in(array_keys((array)$obj->getDb()[$keyPage])), Rule::notIn(request()->session()->get('userId'))]
            ];
            $obj->Validation();
        }else if(Route::currentRouteName() === 'editBranchRays'){
            parent::__construct($obj);
            $this->roll = [
                'id'=>['required', Rule::in(array_keys((array)mydb::find(request()->session()->get('staticId'))[$keyPage]))]
            ];
            $this->message = [
                'id.required'=>$obj->MyInfo()[$keyPage]['IdIsReq'],
                'id.in'=>$obj->MyInfo()[$keyPage]['IdIsInv']
            ];
            $obj->Validation();
        }else if(Route::currentRouteName() === 'deleteItem' || Route::currentRouteName() === 'editFlexTable' || Route::currentRouteName() === 'branch.delete' || Route::currentRouteName() === 'flextable.delete'){
            parent::__construct($obj);
            $this->roll = [
                'id'=>['required', Rule::in(array_keys((array)$obj->getDb()[$keyPage]))]
            ];
            $this->message = [
                'id.required'=>$obj->MyInfo()[$keyPage]['IdIsReq'],
                'id.in'=>$obj->MyInfo()[$keyPage]['IdIsInv']
            ];
            $obj->Validation();
        }else if(Route::currentRouteName() === 'makeChangeLanguage' || Route::currentRouteName() === 'language.change' || Route::currentRouteName() === 'language.delete' || Route::currentRouteName() === 'language.copy'){
            parent::__construct($obj);
            $this->roll = [
                'id'=>['required', Rule::in(array_keys($obj->MyInfo()['AllNamesLanguage']))]
            ];
            $this->message = [
                'id.required'=>$obj->MyInfo()[$keyPage]['IdIsReq'],
                'id.in'=>$obj->MyInfo()[$keyPage]['IdIsInv']
            ];
            $obj->Validation();
        }else if(Route::currentRouteName() === 'editTable' || Route::currentRouteName() === 'deleteTable'){
            parent::__construct($obj);
            $this->roll = [
                'id'=>['required', Rule::in(isset($obj->MyInfo()['MyFlexTables'])?array_keys($obj->MyInfo()['MyFlexTables']):null)]
            ];
            $this->message = [
                'id.required'=>$obj->MyInfo()[$keyPage]['IdIsReq'],
                'id.in'=>$obj->MyInfo()[$keyPage]['IdIsInv'],
            ];
            $obj->Validation();
        }else if(Route::currentRouteName() === 'lang.createLanguage' || Route::currentRouteName() === 'addBranchRays'|| Route::currentRouteName() === 'createFlexTable' || Route::currentRouteName() === 'addTable'){
            parent::__construct($obj);
            $this->successfulyMessage = $obj->myInfo()[$keyPage]['MessageModelCreate'];
            $obj->Validation();
        }else{
            parent::__construct($obj, $keyPage);
            $this->ScreenModelCreate = $obj->MyInfo()[$keyPage]['ScreenModelCreate'];
            $this->ButtonModelCreate = $obj->MyInfo()[$keyPage]['ButtonModelCreate'];
            $this->ButtonModelAdd = $obj->MyInfo()[$keyPage]['ButtonModelAdd'];
            $this->titleModelDelete = $obj->MyInfo()[$keyPage]['ScreenModelDelete'];
            $this->messageModelDelete = $obj->MyInfo()[$keyPage]['MessageModelDelete'];
            $this->buttonModelDelete = $obj->MyInfo()[$keyPage]['ButtonModelDelete'];
            $this->successfully1 = $obj->MyInfo()[$keyPage]['LoadMessage'];
        }
    }
}
