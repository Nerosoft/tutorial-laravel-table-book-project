<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mydb;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
class BranchesController extends ActionController implements DisplayData
{
    function __construct(){
        $this->model = mydb::find(request()->session()->get('userId'));
        $this->error1 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysNameRequired'];
        $this->error2 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysPhoneRequired'];
        $this->error3 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysGovernmentsRequired'];
        $this->error4 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysCityRequired'];
        $this->error5 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysStreetRequired'];
        $this->error6 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysBuildingRequired'];
        $this->error7 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysAddressRequired'];
        $this->error8 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysCountryRequired'];
        $this->error9 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysFollowRequired'];
        $this->error10 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysNameLength'];
        $this->error11 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysPhoneLength'];
        $this->error12 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysGovernmentsLength'];
        $this->error13 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysCityLength'];
        $this->error14 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysStreetLength'];
        $this->error15 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysBuildingLength'];
        $this->error16 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysAddressLength'];
        $this->error17 = $this->getDb()[$this->getDb()['Setting']['Language']]['Branches']['BranceRaysCountryLength'];
        $this->branchInputOutput = $this->getDb()[$this->getDb()['Setting']['Language']]['SelectBranchBox'];
        parent::__construct($this, 'Branches');
    }
    function index(){
        return $this->view;
    }
    function getDataTable(){
        return Branch::fromArray($this, $this->branchInputOutput);
    }
    function getDb(){
        return $this->model;
    }
    function MyInfo(){
        return $this->model[$this->language];
    }
     function setupView(){
        $this->table8 = $this->MyInfo()['Branches']['BranchStreet'];
        $this->table9 = $this->MyInfo()['Branches']['BranchName'];
        $this->table10 = $this->MyInfo()['Branches']['BranchPhone'];
        $this->table16 = $this->MyInfo()['Branches']['BranchGovernments'];
        $this->table17 = $this->MyInfo()['Branches']['BranchCity'];
        $this->table12 = $this->MyInfo()['Branches']['BranchBuilding'];
        $this->table13 = $this->MyInfo()['Branches']['BranchAddress'];
        $this->table14 = $this->MyInfo()['Branches']['BranchCountry'];
        $this->table15 = $this->MyInfo()['Branches']['BranchFollow'];
        //get all hint
        $this->hint1 = $this->MyInfo()['Branches']['BranchRaysName'];
        $this->hint2 = $this->MyInfo()['Branches']['BranchRaysPhone'];
        $this->hint3 = $this->MyInfo()['Branches']['BranchRaysCountry'];
        $this->hint4 = $this->MyInfo()['Branches']['BranchRaysGovernments'];
        $this->hint5 = $this->MyInfo()['Branches']['BranchRaysCity'];
        $this->hint6 = $this->MyInfo()['Branches']['BranchRaysStreet'];
        $this->hint7 = $this->MyInfo()['Branches']['BranchRaysBuilding'];
        $this->hint8 = $this->MyInfo()['Branches']['BranchRaysAddress'];
        $this->selectBox1 = $this->MyInfo()['Branches']['WithRaysOut'];
        $this->view = view('Branch', [
            'lang'=>$this,
        ]);
    }
    function makeAddBranch(){
        $myBranch = $this->getDb()->toArray();
        $myBranch['_id'] =  array_key_last($myBranch['Branches']);
        unset($myBranch['Users'], $myBranch['Branches']);
        mydb::insert($myBranch);
        return $this->makeEditBranch();
    }
    function makeEditBranch(){
        $this->getDb()->save();
        return back()->with('success', $this->successfulyMessage);
    }
    function Validation(){
        $this->roll['brance_rays_name'] = ['required', 'min:3'];
        $this->roll['brance_rays_phone'] = ['required', 'regex:/^[0-9]{11}$/'];
        $this->roll['brance_rays_governments'] = ['required', 'min:3'];
        $this->roll['brance_rays_city'] = ['required', 'min:3'];
        $this->roll['brance_rays_street'] = ['required', 'min:3'];
        $this->roll['brance_rays_building'] = ['required', 'min:3'];
        $this->roll['brance_rays_address'] = ['required', 'min:3'];
        $this->roll['brance_rays_country'] = ['required', 'min:3'];
        $this->roll['brance_rays_follow'] = ['required', Rule::in(array_keys($this->branchInputOutput))];
        $this->message['brance_rays_name.min'] = $this->error10;
        $this->message['brance_rays_name.required'] = $this->error1;
        $this->message['brance_rays_phone.regex'] = $this->error11;
        $this->message['brance_rays_phone.required'] = $this->error2;
        $this->message['brance_rays_governments.min'] = $this->error12;
        $this->message['brance_rays_governments.required'] = $this->error3;
        $this->message['brance_rays_city.min'] = $this->error13;
        $this->message['brance_rays_city.required'] = $this->error4;
        $this->message['brance_rays_street.min'] = $this->error14;
        $this->message['brance_rays_street.required'] = $this->error5;
        $this->message['brance_rays_building.min'] = $this->error15;
        $this->message['brance_rays_building.required'] = $this->error6;
        $this->message['brance_rays_address.min'] = $this->error16;
        $this->message['brance_rays_address.required'] = $this->error7;
        $this->message['brance_rays_country.min'] = $this->error17;
        $this->message['brance_rays_country.required'] = $this->error8;
        $this->message['brance_rays_follow.required'] = $this->error9;
        $this->message['brance_rays_follow.in'] = $this->MyInfo()['Branches']['BranceRaysFollowValue'];
        if(Route::currentRouteName() === 'addBranchRays' && request()->session()->get('staticId') === request()->session()->get('userId')){
            $myId = Str::uuid()->toString();
        }else if(Route::currentRouteName() === 'editBranchRays' && request()->session()->get('staticId') === request()->session()->get('userId')){
            $this->successfulyMessage = $this->MyInfo()['Branches']['MessageModelEdit'];
        }else if(Route::currentRouteName() === 'addBranchRays'){
            $this->model = mydb::find(request()->session()->get('staticId'));
            $myId = Str::uuid()->toString();
        }else{
            $this->successfulyMessage = $this->MyInfo()['Branches']['MessageModelEdit'];
            $this->model = mydb::find(request()->session()->get('staticId'));
        }
        $arr = (array)$this->getDb()['Branches'];
        $arr[$myId??request()->input('id')] = array('Name'=>request()->input('brance_rays_name'), 'Phone'=>request()->input('brance_rays_phone'),'Governments'=>request()->input('brance_rays_governments'), 'City'=>request()->input('brance_rays_city'), 'Street'=>request()->input('brance_rays_street'), 'Building'=>request()->input('brance_rays_building'), 'Address'=>request()->input('brance_rays_address'), 'Country'=>request()->input('brance_rays_country'), 'Follow'=>request()->input('brance_rays_follow'));
        $this->getDb()['Branches'] = $arr;
        request()->validate($this->roll, $this->message);
    }
}
