<?php

use App\MyHelper;
use App\UserStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(UserStatus::TABLE,function (Blueprint $table){
            $table->unsignedBigInteger(UserStatus::COL_ID);
            $table->boolean(UserStatus::COL_NOT_ACTIVATED_ACCOUNT)->default(true);
            $table->boolean(UserStatus::COL_SUSPENDED_ACCOUNT)->default(false);
            $table->boolean(UserStatus::COL_EMAIL_ACTIVATED)->default(false);
            $table->boolean(UserStatus::COL_VERIFIED_PROFILE)->default(false);
            $table->boolean(UserStatus::COL_ACCEPTED_TEACHER)->default(false);
            $table->timestamps();
            $table->foreign(MyHelper::ColName(UserStatus::COL_ID))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE)->onDelete('cascade');
            $table->primary(MyHelper::ColName(UserStatus::COL_ID));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(UserStatus::TABLE);
    }
}
