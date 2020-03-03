<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalGuru extends Model
{
    public const SENIN = 1;
    public const SELASA = 2;
    public const RABU = 3;
    public const KAMIS = 4;
    public const JUMAT = 5;
    public const SABTU = 6;
    public const MINGGU = 0;

    const TABLE = "jadwal_guru";
    const COL_ID = JadwalGuru::TABLE.".id";
    const COL_ID_USER = JadwalGuru::TABLE.".id_user";
    const COL_DAY = JadwalGuru::TABLE.".day";
    const COL_TIME = JadwalGuru::TABLE.".time";
    const COL_CREATED_AT = JadwalGuru::TABLE.".created_at";
    const COL_UPDATED_AT = JadwalGuru::TABLE.".updated_at";
    protected $table = JadwalGuru::TABLE;
}
