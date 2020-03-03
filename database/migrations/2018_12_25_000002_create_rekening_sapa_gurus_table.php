<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningSapaGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\RekeningSapaGuru::TABLE, function (Blueprint $table) {
            $table->tinyIncrements(\App\RekeningSapaGuru::COL_ID);
            $table->string(\App\RekeningSapaGuru::COL_NO_REKENING,50);
            $table->string(\App\RekeningSapaGuru::COL_NAMA,50);
            $table->string(\App\RekeningSapaGuru::COL_BANK,50);
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
        Schema::dropIfExists(\App\RekeningSapaGuru::TABLE);
    }
}
