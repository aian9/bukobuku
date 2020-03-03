<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKodePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\KodePromo::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\KodePromo::COL_ID);
            $table->string(\App\KodePromo::COL_KODE,10);
            $table->unsignedBigInteger(\App\KodePromo::COL_ID_PROMO);
            $table->unsignedBigInteger(\App\KodePromo::COL_ID_USER)->nullable();
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\KodePromo::COL_ID_PROMO))->references(MyHelper::ColName(\App\Promo::COL_ID))->on(\App\Promo::TABLE);
            $table->foreign(MyHelper::ColName(\App\KodePromo::COL_ID_USER))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\KodePromo::TABLE);
    }
}
