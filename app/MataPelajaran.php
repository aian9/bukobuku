<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    const TABLE = "mata_pelajaran";
    const COL_ID = MataPelajaran::TABLE.".id";
    const COL_ID_BIDANG = MataPelajaran::TABLE.".id_bidang";
    const COL_KODE = MataPelajaran::TABLE.".kode";
    const COL_NAMA = MataPelajaran::TABLE.".nama";

    protected $table = MataPelajaran::TABLE;

    // public function jenjang(){
    //     return $this->belongsTo('App\JenjangPendidikan',MyHelper::ColName(MataPelajaran::COL_ID_JENJANG),MyHelper::ColName(JenjangPendidikan::COL_ID));
    // }

    public function bidang(){
        return $this->belongsTo('App\Bidang',MyHelper::ColName(MataPelajaran::COL_ID_BIDANG),MyHelper::ColName(Bidang::COL_ID));
    }
}
