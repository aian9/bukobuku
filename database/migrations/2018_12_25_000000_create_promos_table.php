<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Promo::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\Promo::COL_ID);
            $table->string(\App\Promo::COL_NAMA);
            $table->text(\App\Promo::COL_DESKRIPSI)->nullable();
            $table->dateTime(\App\Promo::COL_TGL_START)->nullable();
            $table->dateTime(\App\Promo::COL_TGL_END)->nullable();
            $table->tinyInteger(\App\Promo::COL_STATUS);
            $table->tinyInteger(\App\Promo::COL_PERSENTASE);
            $table->integer(\App\Promo::COL_MAX_PROMO);
            $table->integer(\App\Promo::COL_MAX_PAKAI);
            $table->tinyInteger(\App\Promo::COL_TIPE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Promo::TABLE);
    }
}
