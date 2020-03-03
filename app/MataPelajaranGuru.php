<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class MataPelajaranGuru extends Model
{
    const TABLE = "mata_pelajaran_guru";
    const COL_ID = MataPelajaranGuru::TABLE.".id";
    const COL_ID_MATPEL = MataPelajaranGuru::TABLE.".id_matpel";
    const COL_ID_USER = MataPelajaranGuru::TABLE.".id_user";
    const COL_TARIF = MataPelajaranGuru::TABLE.".tarif";
    const COL_STATUS = MataPelajaranGuru::TABLE.".status";

    const STATUS_UNVERIFIED = 0;
    const STATUS_VERIFIED = 1;

    protected $table = MataPelajaranGuru::TABLE;

    public function matpel(){
        return $this->belongsTo('App\MataPelajaran',MyHelper::ColName(MataPelajaranGuru::COL_ID_MATPEL),MyHelper::ColName(MataPelajaran::COL_ID));
    }

    public static function getByIduser($id)
    {
        $sql = "select m.id,m.nama from mata_pelajaran m join 
        mata_pelajaran_guru g on m.id=g.id_matpel
        where g.id_user='".$id."' and g.status='1'
        group by m.id,m.nama 
        order by m.nama asc";

        $data = DB::select($sql);

        return $data;
    }

    public static function getTotal($data)
    {
        $sql = "select * from mata_pelajaran_guru where id_user='".$data["id_guru"]."' and id_matpel='".$data["id_matpel"]."'";
        
        $data = DB::select($sql);

        return $data;
    }
}
