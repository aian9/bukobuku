<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    const TABLE = "user_data";
    const COL_ID = UserData::TABLE.".id";
    const COL_NO_IDENTITAS = UserData::TABLE.".no_identitas";
    const COL_NAMA_LENGKAP = UserData::TABLE.".nama_lengkap";
    const COL_NAMA_PANGGILAN = UserData::TABLE.".nama_panggilan";
    const COL_NO_HP = UserData::TABLE.".no_hp";
    const COL_TEMPAT_LAHIR = UserData::TABLE.".tempat_lahir";
    const COL_TANGGAL_LAHIR = UserData::TABLE.".tanggal_lahir";
    const COL_ALAMAT_JALAN = UserData::TABLE.".alamat_jalan";
    const COL_ALAMAT_KECAMATAN = UserData::TABLE.".alamat_kecamatan";
    const COL_ALAMAT_JALAN_DOMISILI = UserData::TABLE.".alamat_jalan_domisili";
    const COL_ALAMAT_KECAMATAN_DOMISILI = UserData::TABLE.".alamat_kecamatan_domisili";
    const COL_JENJANG_PENDIDIKAN = UserData::TABLE.".jenjang_pendidikan";
    const COL_RIWAYAT_PENDIDIKAN = UserData::TABLE.".riwayat_pendidikan";
    const COL_CREATED_AT = UserData::TABLE.".created_at";
    const COL_UPDATED_AT = UserData::TABLE.".updated_at";
    protected $table = UserData::TABLE;
}
