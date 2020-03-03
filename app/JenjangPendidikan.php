<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    const TABLE = "jenjang_pendidikan";
    const COL_ID = JenjangPendidikan::TABLE.".id";
    const COL_NAMA = JenjangPendidikan::TABLE.".nama";
    const COL_TINGKAT = JenjangPendidikan::TABLE.".tingkat";
    const COL_CREATED_AT = JenjangPendidikan::TABLE.".created_at";
    const COL_UPDATED_AT = JenjangPendidikan::TABLE.".updated_at";
    protected $table = JenjangPendidikan::TABLE;
}
