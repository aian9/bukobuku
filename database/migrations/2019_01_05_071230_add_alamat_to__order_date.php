<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlamatToOrderDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(\App\OrderDate::TABLE,function (Blueprint $table){
            $table->string(\App\OrderDate::COL_ALAMAT_JALAN)->after(MyHelper::ColName(\App\OrderDate::COL_DURASI));
            $table->unsignedInteger(\App\OrderDate::COL_ALAMAT_KECAMATAN)->after(MyHelper::ColName(\App\OrderDate::COL_ALAMAT_JALAN));

            $table->foreign(MyHelper::ColName(\App\OrderDate::COL_ALAMAT_KECAMATAN))->references(MyHelper::ColName(\App\Kecamatan::COL_ID))->on(\App\Kecamatan::TABLE);
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
            $table->dropForeign([MyHelper::ColName(\App\OrderDate::COL_ALAMAT_KECAMATAN)]);
            $table->dropColumn(\App\OrderDate::COL_ALAMAT_JALAN);
            $table->dropColumn(\App\OrderDate::COL_ALAMAT_KECAMATAN);
        });
    }
}
