<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    const TABLE = 'notifikasi';
    
    protected $table = Notifikasi::TABLE;

    // public static function getList()
    // {
    // 	$sql = "select ";

    // 	$data = DB::select($sql);


    // 	return $data;
    // }
}
