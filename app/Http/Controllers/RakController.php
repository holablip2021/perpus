<?php

namespace App\Http\Controllers;

use App\CrudRakServices;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class RakController extends Controller
{
    protected $crudservices;

    //
    public function __construct()
    {
        $this->crudservices = new CrudRakServices;
        session()->reflash('status');
    }

    public function index()
    {
        $results = $this->crudservices->index();
        return view('listingrak', compact('results'));
    }

    public function add()
    {
        return 'add rak';
        //return view('frmEntryBuku');
    }

    public function edit($id)
    {
        return 'edit rak' . $id;
        //return view('frmEntryBuku');
    }

    public function create(Request $request)
    {
        $results = $this->crudservices->create($request->post());
        if (!$results) {
            return redirect()->back();
        }
        session()->flash('status', $results['pesan']);
        return redirect(url('/rak/list'));
    }
}
