<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\DataTransfer::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\DataTransfer::COL_ID);
            $table->unsignedBigInteger(\App\DataTransfer::COL_NOMINAL);
            $table->text(\App\DataTransfer::COL_KETERANGAN)->nullable();
            $table->string(\App\DataTransfer::COL_NAMA_PENGIRIM)->nullable();
            $table->string(\App\DataTransfer::COL_NO_REKENING,50)->nullable();
            $table->unsignedTinyInteger(\App\DataTransfer::COL_ID_REK_SG);
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\DataTransfer::COL_ID_REK_SG))->references(MyHelper::ColName(\App\RekeningSapaGuru::COL_ID))->on(\App\RekeningSapaGuru::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\DataTransfer::TABLE);
    }
}
