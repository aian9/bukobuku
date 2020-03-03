<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonfirmasiPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\KonfirmasiPembayaran::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\KonfirmasiPembayaran::COL_ID);
            $table->unsignedBigInteger(\App\KonfirmasiPembayaran::COL_ID_ORDER);
            $table->string(\App\KonfirmasiPembayaran::COL_NAMA,60);
            $table->string(\App\KonfirmasiPembayaran::COL_BANK,50);
            $table->string(\App\KonfirmasiPembayaran::COL_NO_REKENING,60);
            $table->unsignedBigInteger(\App\KonfirmasiPembayaran::COL_NOMINAL);
            $table->text(MyHelper::ColName(\App\KonfirmasiPembayaran::COL_KETERANGAN))->nullable();
            $table->string(\App\KonfirmasiPembayaran::COL_FILEPATH_BUKTI);
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\KonfirmasiPembayaran::COL_ID_ORDER))->references(MyHelper::ColName(\App\Order::COL_ID))->on(\App\Order::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\KonfirmasiPembayaran::TABLE);
    }
}
