<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMataPelajaranGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\MataPelajaranGuru::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\MataPelajaranGuru::COL_ID);
            $table->unsignedSmallInteger(\App\MataPelajaranGuru::COL_ID_MATPEL);
            $table->unsignedBigInteger(\App\MataPelajaranGuru::COL_ID_USER);
            $table->unsignedBigInteger(\App\MataPelajaranGuru::COL_TARIF);
            $table->tinyInteger(\App\MataPelajaranGuru::COL_STATUS);
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\MataPelajaranGuru::COL_ID_MATPEL))->references(MyHelper::ColName(\App\MataPelajaran::COL_ID))->on(\App\MataPelajaran::TABLE);
            $table->foreign(MyHelper::ColName(\App\MataPelajaranGuru::COL_ID_USER))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\MataPelajaranGuru::TABLE);
    }
}
