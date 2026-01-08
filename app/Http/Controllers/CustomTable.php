<?php
namespace App\Http\Controllers;
class CustomTable
{
    /**
     * Create a new class instance.
     */
    private $Name;
    public function __construct($Name)
    {
        $this->Name = $Name;
    }

    public function getName(){
        return $this->Name;
    }
    public static function fromArray(array $data): array {
        $CustomTable = array();
        foreach ($data as $key=>$value)
            $CustomTable[$key] =  new CustomTable($value);
        return $CustomTable;
    }
}