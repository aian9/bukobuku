<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Review::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\Review::COL_ID);
            $table->unsignedBigInteger(MyHelper::ColName(\App\Review::COL_ID_ORDER))->unique();
            $table->tinyInteger(\App\Review::COL_RATING);
            $table->text(\App\Review::COL_REVIEW)->nullable();
            $table->timestamps();

            $table->foreign(MyHelper::ColName(\App\Review::COL_ID_ORDER))->references(MyHelper::ColName(\App\Order::COL_ID))->on(\App\Order::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Review::TABLE);
    }
}
