<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDate extends Model
{
    const TABLE = "order_date";
    const COL_ID = OrderDate::TABLE.".id";
    const COL_ID_ORDER = OrderDate::TABLE.".id_order";
    const COL_DATETIME = OrderDate::TABLE.".datetime";
    const COL_DATETIME_END = OrderDate::TABLE.".datetime_end";
    const COL_DURASI = OrderDate::TABLE.".durasi";
    const COL_ALAMAT_JALAN = OrderDate::TABLE.".alamat_jalan";
    const COL_ALAMAT_KECAMATAN = OrderDate::TABLE.".alamat_kecamatan";
    const COL_KETERANGAN = OrderDate::TABLE.".keterangan";
    const COL_CREATED_AT = OrderDate::TABLE.".created_at";
    const COL_UPDATED_AT = OrderDate::TABLE.".updated_at";

    protected $table = OrderDate::TABLE;

    public function kecamatan(){
        return $this->belongsTo('App\Kecamatan',MyHelper::ColName(OrderDate::COL_ALAMAT_KECAMATAN),MyHelper::ColName(Kecamatan::COL_ID));
    }
}
