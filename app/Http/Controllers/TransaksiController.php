<?php

namespace App\Http\Controllers;

use App\CrudTransaksiServices;
use App\CrudRakServices;
use App\CrudBukuServices;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    protected $crudservices, $crudBukuservices, $crudRakservices;

    //
    public function __construct()
    {
        
        $this->crudservices = new CrudTransaksiServices;
        $this->crudBukuservices = new CrudBukuServices;
        $this->crudRakservices = new CrudRakServices;
        session()->reflash('status');
    }

    public function index()
    {
        
        $results = $this->crudBukuservices->index();
        return view('catalog', compact('results'));
    }

    public function cekstok($id = null){
        $results = $this->crudservices->stok($id);
        if(!$results){
        return redirect()->back();    
        }
        session()->flash('status', $results['pesan']);
        return view('order', compact('results'));
    }

    public function order($id = null){
        $results = $this->crudservices->memberOrder($id);
        if (!$results) {
            return redirect()->back();
        }
        session()->flash('status', $results['pesan']);
        return redirect(url('/produk/list'));
    }    

    //pesanan
    public function pesanan()
    {
        $results = $this->crudservices->pesanan();
        return view('listingpesanan', compact('results'));
    }

    //transaksi keluar
    public function keluar($id = null,Request $request){
        $results = $this->crudservices->updateTransaksiKeluar($id, $request);
        if (!$results) {
            return redirect()->back();
        }
        session()->flash('status', $results['pesan']);
        return redirect(url('/pesanan/list'));
    }

    public function penerimaan()
    {
        $results = $this->crudservices->penerimaan();
        return view('listingpenerimaan', compact('results'));
    }

    //transaksi masuk
    public function masuk($id = null, Request $request)
    {
        $results = $this->crudservices->updateTransaksiMasuk($id, $request);
        if (!$results) {
            return redirect()->back();
        }
        session()->flash('status', $results['pesan']);
        return redirect(url('/penerimaan/list'));        
    }

    //transaksi adjustment
    public function adjustmentsaldo()
    {
        $resultsRak = $this->crudRakservices->index();
        return view('adjustment',compact('resultsRak'));
    }

    public function adjustmentmasuk(Request $request){
        $results = $this->crudservices->transaksiPenyesuaian($request);
        session()->flash('status', $results['pesan']); 
        if(!$results){
            return redirect(url('/penyesuaian'));
        }
        return redirect(url('/penyesuaian'));
    }    

}
