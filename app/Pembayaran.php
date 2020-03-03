<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    const TABLE = 'pembayaran';
    const COL_ID = Pembayaran::TABLE.".id";
    const COL_ID_ORDER = Pembayaran::TABLE.".id_tagihan";
    const COL_ID_METODE = Pembayaran::TABLE.".metode";
    const COL_NAMA = Pembayaran::TABLE.".nama";
    const COL_ID_BANK = Pembayaran::TABLE.".id_bank";
    const COL_NO_REKENING = Pembayaran::TABLE.".no_rekening";
    const COL_NOMINAL = Pembayaran::TABLE.".nominal";
    const COL_KETERANGAN = Pembayaran::TABLE.".keterangan";
    const COL_FILEPATH_BUKTI = Pembayaran::TABLE.".filepath_bukti";
    const COL_CREATED_AT = Pembayaran::TABLE.".created_at";
    const COL_UPDATED_AT = Pembayaran::TABLE.".updated_at";

    const BUKTI_PEMBAYARAN_DIR = 'bukti';

    protected $table = Pembayaran::TABLE;
}
