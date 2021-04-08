<?php

namespace App;
use App\UsersRepository;
use App\TransaksiRepository;

class CrudUsersServices
{
    protected $listrepo;protected $userTransRepo;

    public function __construct(){
        $this->listrepo = new UsersRepository;
        //session()->reflash();
    }

    //buat data baru
    public function create($data){
        $pesan = ['status' => false, 'pesan' => ''];
        try {
            $simpan = new Users;
            $simpan->nama = $data['reg_nama'];
            $simpan->alamat = $data['reg_alamat'];
            $simpan->telepon = $data['reg_telp'];
            $simpan->role_id = $data['reg_role'];
            $simpan->email = $data['reg_email'];
            $simpan->password = $data['reg_password'];
            $simpan->save();
            $pesan['status'] = true;
            $pesan['pesan'] = 'Registrasi berhasil,silahkan login';
        } catch (\Exception $e) {
            $pesan['status'] = false;
            $pesan['pesan'] = 'Registrasi ditolak';
            return $pesan;
        }
        return $pesan;
    }

    //tampilkan list 
    public function index(){
        $results =  $this->listrepo->getUsers();
        return $results;
    }

    //updata data
    public function validasi_user($data)
    {
        $pesan = ['status' => false, 'pesan' => ''];
        try {
            $results =  $this->listrepo->getUsers()->where('email',$data['Email'])->where('password', $data['Password'])->where('role_id', $data['role'])->first();
            $pesan['status'] = true;
            $pesan['pesan'] = 'Anda telah login';
            session()->put('users', $results->email);
            session()->put('role', $results->role_id);
            session()->put('user_id', $results->id);
        } catch (\Exception $e) {
            $pesan['status'] = false;
            $pesan['pesan'] = 'User atau Password salah';
            return $pesan;
        }        
        return $pesan;
    }

    public function transaksiMember($id)
    {
        $results =  $this->listrepo->findUserTransaksi($id);
        return $results;
    }


}
