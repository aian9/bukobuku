<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    const TABLE = "kecamatan";
    const COL_ID = Kecamatan::TABLE.".id";
    const COL_NAMA = Kecamatan::TABLE.".nama";
    const COL_KODE_KECAMATAN = Kecamatan::TABLE.".kode_kecamatan";
    const COL_ID_KOTA = Kecamatan::TABLE.".id_kota";
    const COL_CREATED_AT = Kecamatan::TABLE.".created_at";
    const COL_UPDATED_AT = Kecamatan::TABLE.".updated_at";

    protected $table = Kecamatan::TABLE;

    public function kota(){
        return $this->belongsTo('App\KotaKab', 'id_kota','id');
    }
}
