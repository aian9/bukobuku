<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\ReportOrder::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\ReportOrder::COL_ID);
            $table->unsignedBigInteger(\App\ReportOrder::COL_ID_ORDER);
            $table->string(\App\ReportOrder::COL_SUBJECT,120);
            $table->text(\App\ReportOrder::COL_DESCRIPTION);
            $table->text(\App\ReportOrder::COL_REPLY)->nullable();
            $table->tinyInteger(\App\ReportOrder::COL_STATUS)->default(\App\ReportOrder::STATUS_CREATED);
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\ReportOrder::COL_ID_ORDER))->references(MyHelper::ColName(\App\Order::COL_ID))->on(\App\Order::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\ReportOrder::TABLE);
    }
}
