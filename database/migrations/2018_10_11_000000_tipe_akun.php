<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipeAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\TipeAkun::TABLE, function (Blueprint $table) {
            $table->smallIncrements(\App\TipeAkun::COL_ID);
            $table->string(\App\TipeAkun::COL_NAMA,50);
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
        Schema::dropIfExists('tipe_akun');
    }
}
