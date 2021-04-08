<?php

namespace App;
use App\Rak;
class RakRepository
{
    //
    public function findById($id)
    {
        return Rak::with([])
        ->find($id);
    }

    public function getRak()
    {
       return Rak::with(['buku_rak'])
            ->get();
    }

}
