<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Provinsi extends Model
{
    const TABLE = "provinsi";
    const COL_ID = Provinsi::TABLE.".id";
    const COL_NAMA = Provinsi::TABLE.".nama";
    const COL_CREATED_AT = Provinsi::TABLE.".created_at";
    const COL_UPDATED_AT = Provinsi::TABLE.".updated_at";
    
    protected $table = Provinsi::TABLE;
    
    public static function index()
    {
    	$data = DB::table(Provinsi::TABLE)->get()->toArray();
    	
   	 	return $data;
    }

    public function kota(){
        return $this->hasMany('App\KotaKab','id_provinsi','id');
    }
}
