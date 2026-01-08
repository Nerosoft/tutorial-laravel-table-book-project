<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyLanguage extends Controller
{
    private $name;
    function __construct($name){
        $this->name = $name;
    }
    function getName(){
        return $this->name;
    }
    static function fromArray(array $lang):array{
        $array = array();
        foreach ($lang as $key => $value) 
            $array[$key] = new MyLanguage($value);
        return $array;
    }
}
