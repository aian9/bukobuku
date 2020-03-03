<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bank extends Model
{
    protected $fillable = array('kode_bank', 'nama_bank');

    protected $table = "bank";

    public function index()
    {
        $data = DB::table($this->table)->get()->toArray();
        
        return $data;
    }
}
