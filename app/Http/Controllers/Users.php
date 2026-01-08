<?php
namespace App\Http\Controllers;
use App\Models\mydb;
class Users
{
    /**
     * Create a new class instance.
     */
    private $Email;
    private $Password;
    function __construct($Email, $Password)
    {
        $this->Email = $Email;
        $this->Password = $Password;
    }
    function getEmail(){
        return $this->Email;
    }
    function getPassword(){
        return $this->Password;
    }
    static function fromArray($users){
        $arr = array();
        foreach ($users as $key => $user)
            $arr[$key] = new Users($user['Email'], $user['Password']);
        return $arr;
    }
}
