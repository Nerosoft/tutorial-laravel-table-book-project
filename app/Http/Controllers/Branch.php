<?php
namespace App\Http\Controllers;
use App\Models\mydb;
class Branch
{
    /**
     * Create a new class instance.
     */
    private $Name;
    private $Phone;
    private $Governments;
    private $City;
    private $Street;
    private $Building;
    private $Address;
    private $Country;
    private $Follow;
    function __construct($Name, $Phone = null, $Governments = null,
    $City = null, $Street = null, $Building = null, $Address = null, $Country = null, $Follow = null)
    {
        $this->Name = $Name;
        $this->Phone = $Phone;
        $this->Governments = $Governments;
        $this->City = $City;
        $this->Street = $Street;
        $this->Building = $Building;
        $this->Address = $Address;
        $this->Country = $Country;
        $this->Follow = $Follow;
    }
    function getName(){
        return $this->Name;
    }
    function getPhone(){
        return $this->Phone;
    }
    function getGovernments(){
        return $this->Governments;
    }
    function getCity(){
        return $this->City;
    }
    function getStreet(){
        return $this->Street;
    }
    function getBuilding(){
        return $this->Building;
    }
    function getAddress(){
        return $this->Address;
    }
    function getCountry(){
        return $this->Country;
    }
    function getFollowId(){
        return $this->Follow;
    }
    static function fromArray(Database $obj, $follow = null){
        $allBranch = array();
        if(isset($obj->getDb()['Branches']) || isset(mydb::find(request()->session()->get('staticId'))['Branches']))
            foreach ($obj?->getDb()['Branches']??mydb::find(request()->session()->get('staticId'))['Branches'] as $key => $branch)
                $allBranch[$key] = is_null($follow)?new Branch($branch['Name']):new Branch($branch['Name'], $branch['Phone'],
                $branch['Governments'], $branch['City'], $branch['Street'], $branch['Building'], $branch['Address'],
                $branch['Country'], $follow[$branch['Follow']]);
        return $allBranch;
    }
}
