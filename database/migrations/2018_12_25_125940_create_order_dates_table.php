<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\OrderDate::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\OrderDate::COL_ID);
            $table->unsignedBigInteger(\App\OrderDate::COL_ID_ORDER);
            $table->dateTime(\App\OrderDate::COL_DATETIME);
            $table->double(\App\OrderDate::COL_DURASI);
            $table->text(\App\OrderDate::COL_KETERANGAN)->nullable();
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\OrderDate::COL_ID_ORDER))->references(MyHelper::ColName(\App\Order::COL_ID))->on(\App\Order::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\OrderDate::TABLE);
    }
}
