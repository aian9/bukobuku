<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JenjangPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\JenjangPendidikan::TABLE, function (Blueprint $table) {
            $table->smallIncrements(\App\JenjangPendidikan::COL_ID);
            $table->string(\App\JenjangPendidikan::COL_NAMA,50);
            $table->string(\App\JenjangPendidikan::COL_TINGKAT,15)->nullable();
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
        Schema::dropIfExists('jenjang_pendidikan');
    }
}
