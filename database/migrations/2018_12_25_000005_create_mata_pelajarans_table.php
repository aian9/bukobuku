<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\MataPelajaran::TABLE, function (Blueprint $table) {
            $table->smallIncrements(\App\MataPelajaran::COL_ID);
            $table->unsignedSmallInteger(\App\MataPelajaran::COL_ID_JENJANG);
            $table->string(\App\MataPelajaran::COL_KODE, 20);
            $table->string(\App\MataPelajaran::COL_NAMA, 50);
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\MataPelajaran::COL_ID_JENJANG))->references(MyHelper::ColName(\App\JenjangPendidikan::COL_ID))->on(\App\JenjangPendidikan::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\MataPelajaran::TABLE);
    }
}
