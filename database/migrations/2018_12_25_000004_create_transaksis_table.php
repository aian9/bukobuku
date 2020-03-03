<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Transaksi::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\Transaksi::COL_ID);
            $table->unsignedBigInteger(\App\Transaksi::COL_ID_USER);
            $table->unsignedBigInteger(MyHelper::ColName(\App\Transaksi::COL_ID_DATA_TRANSFER))->nullable()->unique();
            $table->tinyInteger(\App\Transaksi::COL_TIPE);
            $table->unsignedBigInteger(\App\Transaksi::COL_NOMINAL);
            $table->text(\App\Transaksi::COL_KETERANGAN)->nullable();
            $table->tinyInteger(\App\Transaksi::COL_STATUS);
            $table->timestamps();


            $table->foreign(MyHelper::ColName(\App\Transaksi::COL_ID_USER))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE);
            $table->foreign(MyHelper::ColName(\App\Transaksi::COL_ID_DATA_TRANSFER))->references(MyHelper::ColName(\App\DataTransfer::COL_ID))->on(\App\DataTransfer::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Transaksi::TABLE);
    }
}
