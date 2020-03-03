<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    const TABLE = "promo";
    const COL_ID = Promo::TABLE.".id";
    const COL_NAMA = Promo::TABLE.".nama";
    const COL_DESKRIPSI = Promo::TABLE.".deskripsi";
    const COL_TGL_START = Promo::TABLE.".tgl_start";
    const COL_TGL_END = Promo::TABLE.".tgl_end";
    const COL_STATUS = Promo::TABLE.".status";
    const COL_PERSENTASE = Promo::TABLE.".persentase";
    const COL_MAX_PROMO = Promo::TABLE.".max_promo";
    const COL_MAX_PAKAI = Promo::TABLE.".max_pakai";
    const COL_TIPE = Promo::TABLE.".tipe";
    const COL_CREATED_AT = Promo::TABLE.".created_at";
    const COL_UPDATED_AT = Promo::TABLE.".updated_at";

    const TIPE_SINGLE_USER = 1;
    const TIPE_MULTIPLE_USER = 2;

    protected $table = Promo::TABLE;
}
