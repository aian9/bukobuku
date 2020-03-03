<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    const TABLE = "bidang";
    const COL_ID = Bidang::TABLE.".id";
    const COL_NAMA_BIDANG = Bidang::TABLE.".nama_bidang";
    const COL_CREATED_AT = Bidang::TABLE.".created_at";
    const COL_UPDATED_AT = Bidang::TABLE.".updated_at";

    protected $table = Bidang::TABLE;
}
