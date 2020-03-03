<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTransfer extends Model
{
    const TABLE = "data_transfer";
    const COL_ID = DataTransfer::TABLE.".id";
    const COL_NOMINAL = DataTransfer::TABLE.".nominal";
    const COL_ID_REK_SG = DataTransfer::TABLE.".id_rek_sg";
    const COL_KETERANGAN = DataTransfer::TABLE.".keterangan";
    const COL_NAMA_PENGIRIM = DataTransfer::TABLE.".nama_pengirim";
    const COL_NO_REKENING = DataTransfer::TABLE.".no_rekening";
    const COL_TGL_TRANSFER = DataTransfer::TABLE.".tgl_transfer";
    
    protected $table = DataTransfer::TABLE;
}
