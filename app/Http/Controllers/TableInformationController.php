<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableInformationController extends AdminMenuController
{
    function __construct(Validation | Viewphp $obj, $keyPage = null){
        if(is_null($keyPage))
            parent::__construct($obj); 
        else{
            parent::__construct($obj, $keyPage);
            $this->Ssearch = $obj->MyInfo()['TableInfo']['Ssearch'];
            $this->InfoEmpty = $obj->MyInfo()['TableInfo']['InfoEmpty'];
            $this->ZeroRecords = $obj->MyInfo()['TableInfo']['ZeroRecords'];
            $this->Info = $obj->MyInfo()['TableInfo']['Info'];
            $this->LengthMenu = $obj->MyInfo()['TableInfo']['LengthMenu'];
            $this->InfoFiltered = $obj->MyInfo()['TableInfo']['InfoFiltered'];
            $this->TableId = $obj->MyInfo()[$keyPage]['TableId'];
            $this->TabelEvent = $obj->MyInfo()[$keyPage]['TabelEvent'];
            $this->ButtonModelEdit = $obj->MyInfo()[$keyPage]['ButtonModelEdit'];
            $this->ScreenModelEdit = $obj->MyInfo()[$keyPage]['ScreenModelEdit'];
            $obj->setupView();
        }
        
    }
}
