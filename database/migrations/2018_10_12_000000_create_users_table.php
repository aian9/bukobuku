<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\User::TABLE, function (Blueprint $table) {
            $table->bigIncrements(\App\User::COL_ID);
            $table->string(MyHelper::ColName(\App\User::COL_EMAIL),100)->unique();
            $table->string(MyHelper::ColName(\App\User::COL_USERNAME),50)->unique();
            $table->string(\App\User::COL_PASSWORD,100);
            $table->smallInteger(\App\User::COL_STATUS);
            $table->unsignedSmallInteger(\App\User::COL_TIPE_AKUN);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign(MyHelper::ColName(\App\User::COL_TIPE_AKUN))->references(MyHelper::ColName(\App\TipeAkun::COL_ID))->on(\App\TipeAkun::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
