<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

abstract class Controller
{
    protected function generateUniqueIdentifier($length = 2){
        return Str::random($length) . substr(uniqid(), -6);
    }
}
