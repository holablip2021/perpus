<?php

namespace App;
use App\RakRepository;

class CrudRakServices
{
    protected $listrepo;

    public function __construct(){
        $this->listrepo = new RakRepository;
        //session()->reflash();        
    }


    //tampilkan list 
    public function index(){
        $results =  $this->listrepo->getRak();
        return $results;
    }


    //buat data baru
    public function create($data)
    {
        $pesan = ['status' => false, 'pesan' => ''];
        try {
            $simpan = new Rak;
            $simpan->deskripsi = $data['field_deskripsi_rak'];
            $simpan->save();
            $pesan['status'] = true;
            $pesan['pesan'] = 'Data berhasil disimpan';
        } catch (\Exception $e) {
            $pesan['status'] = false;
            $pesan['pesan'] = $e->getMessage();
            return $pesan;
        }
        return $pesan;
    }    

}
