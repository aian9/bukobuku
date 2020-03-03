<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNominalToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(\App\Order::TABLE,function (Blueprint $table){
            $table->unsignedBigInteger(\App\Order::COL_NOMINAL)->after(MyHelper::ColName(\App\Order::COL_STATUS));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\App\Order::TABLE,function (Blueprint $table){
            $table->dropColumn(\App\Order::COL_NOMINAL);
        });
    }
}
