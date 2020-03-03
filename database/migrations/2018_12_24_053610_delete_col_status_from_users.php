<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColStatusFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(\App\User::TABLE, function (Blueprint $table){
            $table->dropColumn(\App\User::COL_STATUS);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\App\User::TABLE, function (Blueprint $table){
            $table->smallInteger(\App\User::COL_STATUS);
        });
    }
}
