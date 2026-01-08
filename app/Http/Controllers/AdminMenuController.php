<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminMenuController extends InformationPageController
{
    function __construct(Database $obj, $keyPage = null){
        if(is_null($keyPage))
            parent::__construct($obj->getDb()['Setting']['Language']);
        else{
            parent::__construct($obj->getDb()['Setting']['Language'], $obj, $keyPage);
            $this->BranchesCompany = $obj->MyInfo()['AppSettingAdmin']['BranchesCompany'];
            $this->Offcanvas = $obj->MyInfo()['AppSettingAdmin']['Offcanvas'];
            $this->Logout = $obj->MyInfo()['AppSettingAdmin']['Logout'];
            $this->AdminDashboard = $obj->MyInfo()['AppSettingAdmin']['AdminDashboard'];
            $this->MyBranch = array(request()->session()->get('staticId')=>new Branch($obj->MyInfo()['AppSettingAdmin']['BranchMain']),
            ...Branch::fromArray($obj));
            if(Route::currentRouteName() === 'SystemLang'){
                $this->myMenuApp = array('Home'=>$obj->MyInfo()['Menu']['Home'], 'SystemLang'=>$obj->MyInfo()['Menu']['SystemLang']);
                foreach ($obj->MyInfo()['AllNamesLanguage'] as $key => $value){
                    $this->myMenuApp[$key] = array($value);
                    foreach (array_keys($obj->MyInfo()) as $key2 => $table) 
                        $this->myMenuApp[$key][$table] = $obj?->MyInfo()[$table]['MYTITLE']??$obj->MyInfo()['AppSettingAdmin'][$table];
                }
            }
            else if(isset($obj->MyInfo()['MyFlexTables'])){
               $this->myMenuApp = $obj->MyInfo()['Menu'];
               $arr = $obj->MyInfo()['MyFlexTables'];
               array_unshift($arr, $this->myMenuApp['MyFlexTables']);
               $this->myMenuApp['MyFlexTables'] = $arr;
            }else{
                $this->myMenuApp = $obj->MyInfo()['Menu'];
                unset($this->myMenuApp['MyFlexTables']);
            }
        }
    }
    public function getIconByKey($key){
        if($key === 'Home')//--
            return 'box-arrow-left.svg';
        else if($key === 'SystemLang')
                return 'gear.svg';  
        else if($key === 'ChangeLanguage')
            return 'globe-asia-australia.svg';
        else if($key === 'Branches')
            return 'hospital.svg';
        else if($key === 'Login')
            return 'database-exclamation.svg';
        else if($key === 'Register')
            return 'arrows.svg';
        else if($key === 'Menu')
            return 'menu-button-fill.svg';
        else if($key === 'TableInfo')
            return 'person-add.svg';
        else if($key === 'AppSettingAdmin')
            return 'box.svg';
        else if($key === 'SelectBranchBox')
            return 'gear.svg';
        else if($key === 'AllNamesLanguage')
            return 'bag-check-fill.svg';
        else if($key === 'CustomTable')
            return 'arrow-up-circle-fill.svg';
        else if($key === 'TablePage')
            return 'calendar4-event.svg';
        else if($key === 'Html')
            return 'bar-chart-line-fill.svg';
        else
            return 'camera2.svg';
    }
}
