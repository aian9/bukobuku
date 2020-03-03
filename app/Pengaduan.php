<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    const TABLE = 'pengaduan';
    
    protected $table = Pengaduan::TABLE;


    public static function getList()
    {
    	$sql = "select p.id, p.id_jadwal,p.pengaduan,p.created_at,o.kode_transaksi,u.nama_lengkap
                from pengaduan p
                join order_date d on p.id_jadwal=d.id
                join `order` o on d.id_order=o.id
                join user_data u on o.id_murid=u.id";
        
        $a_data = DB::select($sql);
        
        return $a_data;
    }
}
