<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Order::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\Order::COL_ID);
            $table->unsignedBigInteger(\App\Order::COL_ID_GURU);
            $table->unsignedBigInteger(\App\Order::COL_ID_MURID);
            $table->unsignedSmallInteger(\App\Order::COL_ID_MATPEL);
            $table->text(\App\Order::COL_KETERANGAN)->nullable();
            $table->unsignedBigInteger(MyHelper::ColName(\App\Order::COL_TRANSAKSI))->nullable()->unique();
            $table->unsignedBigInteger(\App\Order::COL_ID_KODE_PROMO)->nullable();
            $table->tinyInteger(\App\Order::COL_STATUS)->default(0);
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\Order::COL_ID_GURU))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE);
            $table->foreign(MyHelper::ColName(\App\Order::COL_ID_MURID))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE);
            $table->foreign(MyHelper::ColName(\App\Order::COL_ID_MATPEL))->references(MyHelper::ColName(\App\MataPelajaran::COL_ID))->on(\App\MataPelajaran::TABLE);
            //transaksi & promo
            $table->foreign(MyHelper::ColName(\App\Order::COL_ID_KODE_PROMO))->references(MyHelper::ColName(\App\KodePromo::COL_ID))->on(\App\KodePromo::TABLE);
            $table->foreign(MyHelper::ColName(\App\Order::COL_TRANSAKSI))->references(MyHelper::ColName(\App\Transaksi::COL_ID))->on(\App\Transaksi::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Order::TABLE);
    }
}
