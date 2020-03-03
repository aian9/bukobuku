<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KotaKab extends Model
{
    const TABLE = "kota_kab";
    const COL_ID = KotaKab::TABLE.".id";
    const COL_NAMA = KotaKab::TABLE.".nama";
    const COL_KODE_KOTA = KotaKab::TABLE.".kode_kota";
    const COL_ID_PROVINSI = KotaKab::TABLE.".id_provinsi";
    const COL_CREATED_AT = KotaKab::TABLE.".created_at";
    const COL_UPDATED_AT = KotaKab::TABLE.".updated_at";

    protected $table = KotaKab::TABLE;

    public function index()
    {
        $data = DB::table($this->table)->get()->toArray();
        
        return $data;
    }

    public function provinsi(){
        return $this->belongsTo('App\Provinsi', 'id_provinsi','id');
    }

    public function kecamatan(){
        return $this->hasMany('App\Kecamatan','id_kota','id');
    }
}
