<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatetimeendToOrderDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(\App\OrderDate::TABLE,function (Blueprint $table){
            $table->dateTime(\App\OrderDate::COL_DATETIME_END)->after(MyHelper::ColName(\App\OrderDate::COL_DATETIME));

            $table->index(MyHelper::ColName(\App\OrderDate::COL_DATETIME));
            $table->index(MyHelper::ColName(\App\OrderDate::COL_DATETIME_END));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\App\OrderDate::TABLE,function (Blueprint $table){
            $table->dropIndex([MyHelper::ColName(\App\OrderDate::COL_DATETIME)]);
            $table->dropIndex([MyHelper::ColName(\App\OrderDate::COL_DATETIME_END)]);

            $table->dropColumn(\App\OrderDate::COL_DATETIME_END);
        });
    }
}
