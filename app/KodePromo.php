<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodePromo extends Model
{
    const TABLE = "kode_promo";
    const COL_ID = KodePromo::TABLE.".id";
    const COL_KODE = KodePromo::TABLE.".kode";
    const COL_ID_PROMO = KodePromo::TABLE.".id_promo";
    //const COL_ID_ORDER = KodePromo::TABLE.".id_order";
    const COL_ID_USER = KodePromo::TABLE.".id_user";
    const COL_CREATED_AT = KodePromo::TABLE.".created_at";
    const COL_UPDATED_AT = KodePromo::TABLE.".updated_at";

    protected $table = KodePromo::TABLE;
}
