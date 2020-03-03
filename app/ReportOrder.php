<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportOrder extends Model
{
    const TABLE = "report_order";
    const COL_ID = self::TABLE.".id";
    const COL_ID_ORDER = self::TABLE.".id_order";
    const COL_SUBJECT = self::TABLE.".subject";
    const COL_DESCRIPTION = self::TABLE.".description";
    const COL_REPLY = self::TABLE.".reply";
    const COL_STATUS = self::TABLE.".status";
    const COL_CREATED_AT = self::TABLE.".created_at";
    const COL_UPDATED_AT = self::TABLE.".updated_at";

    const STATUS_CREATED = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_REPLIED = 2;
    const STATUS_DONE = 3;

    protected $table = self::TABLE;
}
