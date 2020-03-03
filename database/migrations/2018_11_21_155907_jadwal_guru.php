<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JadwalGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(\App\JadwalGuru::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\JadwalGuru::COL_ID);
            $table->unsignedBigInteger(\App\JadwalGuru::COL_ID_USER);
            $table->tinyInteger(\App\JadwalGuru::COL_DAY);
            $table->tinyInteger(\App\JadwalGuru::COL_TIME);
            $table->tinyInteger("end_time");
            $table->timestamps();
            //$table->foreign(MyHelper::ColName(\App\JadwalGuru::COL_ID_USER))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE)->onDelete('cascade');
            $table->index(MyHelper::ColName(\App\JadwalGuru::COL_DAY));
            $table->index(MyHelper::ColName(\App\JadwalGuru::COL_TIME));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\JadwalGuru::TABLE);
    }
}
