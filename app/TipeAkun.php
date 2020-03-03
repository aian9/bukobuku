<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeAkun extends Model
{
    const TABLE = "tipe_akun";
    const COL_ID = TipeAkun::TABLE.".id";
    const COL_NAMA = TipeAkun::TABLE.".nama";
    const COL_CREATED_AT = TipeAkun::TABLE.".created_at";
    const COL_UPDATED_AT = TipeAkun::TABLE.".updated_at";
    protected $table = TipeAkun::TABLE;
}
