<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\DataGuru::TABLE, function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->unsignedBigInteger(\App\DataGuru::COL_ID);
            $table->text(\App\DataGuru::COL_RIWAYAT_PENDIDIKAN)->nullable();
            $table->timestamps();
            $table->foreign(MyHelper::ColName(\App\DataGuru::COL_ID))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE)->onDelete('cascade');
            $table->primary(MyHelper::ColName(\App\DataGuru::COL_ID));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_guru');
    }
}
