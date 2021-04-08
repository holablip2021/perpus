<?php

namespace App;
use App\BukuRepository;

class CrudBukuServices
{
    protected $listrepo;

    public function __construct(){
        $this->listrepo = new BukuRepository;
        //session()->reflash();        
    }


    //tampilkan list 
    public function index(){
        $results =  $this->listrepo->getBuku();
        return $results;
    }

}
