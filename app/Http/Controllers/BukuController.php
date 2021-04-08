<?php

namespace App\Http\Controllers;

use App\CrudBukuServices;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class BukuController extends Controller
{
    protected $crudservices;

    //
    public function __construct()
    {
        $this->crudservices = new CrudBukuServices;
        session()->reflash('status');
    }
    
    public function index()
    {
        $results = $this->crudservices->index();
        return view('listingbuku', compact('results'));
    }

    public function add()
    {   
        return 'add buku';
        //return view('frmEntryBuku');
    }

    public function edit($id)
    {
        return 'edit buku' . $id;
        //return view('frmEntryBuku');
    }

    public function delete($id)
    {
        return 'delete buku' . $id;
        //return view('frmEntryBuku');
    }


}
