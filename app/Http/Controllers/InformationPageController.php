<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationPageController extends Controller
{
    function __construct($language, Database $obj = null, $keyPage = null){
        if(is_null($obj))
            $this->language = $language;
        else{
            $this->language = $language;
            $this->direction = $obj->MyInfo()['Html']['Direction'];
            $this->title = $obj->MyInfo()[$keyPage]['Title'];
        }
    }
}
