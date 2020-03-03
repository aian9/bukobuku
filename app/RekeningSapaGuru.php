<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekeningSapaGuru extends Model
{
    const TABLE = "rekening_sapaguru";
    const COL_ID = RekeningSapaGuru::TABLE.".id";
    const COL_NO_REKENING = RekeningSapaGuru::TABLE.".no_rekening";
    const COL_NAMA = RekeningSapaGuru::TABLE.".nama";
    const COL_BANK = RekeningSapaGuru::TABLE.".bank";
    const COL_CREATED_AT = RekeningSapaGuru::TABLE.".created_at";
    const COL_UPDATED_AT = RekeningSapaGuru::TABLE.".updated_at";

    protected $table = RekeningSapaGuru::TABLE;
}
