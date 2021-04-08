<?php

namespace App\Http\Controllers;

use App\CrudUsersServices;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    protected $crudservices;

    //
    public function __construct()
    {
        $this->crudservices = new CrudUsersServices;
        session()->reflash('status');
    }

    public function login()
    {
        return view('login');
    }


    public function cekLogin(Request $request)
    {
        $results = $this->crudservices->validasi_user($request->post());
        if (!$results) {
            return redirect(url('/pengguna/login'));
        }
        session()->flash('status', $results['pesan']);
        return redirect('/');
    }    

    public function index()
    {
        $results = $this->crudservices->index();
        return view('listingusers', compact('results'));
    }

    public function add()
    {
        return 'add users';
    }

    public function edit($id)
    {
        return 'edit user' . $id;
    }

    public function delete($id)
    {
        return 'delete user' . $id;
    }

    public function registrasi(Request $request)
    {   
        $results = $this->crudservices->create($request->post());
        if (!$results) {
            return redirect()->back();
        }
        session()->flash('status', $results['pesan']);
        return view('login',compact('results'));
    }


    public function transaksi()
    {
        $results = $this->crudservices->transaksiMember(session()->get('user_id'));
        if(!$results){
            return redirect()->back();
        }
        return view('listingtransaksi', compact('results'));
    }
    
}
