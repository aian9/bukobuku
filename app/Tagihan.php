<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tagihan extends Model
{
    protected $fillable = array('id_order', 'id_user', 'nominal', 'id_bank', 'metode', 'status', 'create_date', 'expired_date');

    protected $table = "tagihan";
    
    public function index()
    {
        $data = DB::table($this->table)->get()->toArray();
        
        return $data;
    }

    public static function getTagihan($id)
    {   
        $sql = "select * from tagihan where id_order='".$id."' and expired_date > '".date("Y-m-d H:i:s")."'";
        
        $data = DB::select($sql);

        return $data;
    }
}
