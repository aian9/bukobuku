<?php

use App\MyHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\UserData::TABLE, function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->unsignedBigInteger(\App\UserData::COL_ID);
            $table->string(\App\UserData::COL_NO_IDENTITAS,50)->nullable();
            $table->string(\App\UserData::COL_NAMA_LENGKAP,100)->nullable();
            $table->enum('jenis_kelamin', array('Laki-Laki','Perempuan'))->nullable();
            $table->string(\App\UserData::COL_NAMA_PANGGILAN,20)->nullable();
            $table->string(\App\UserData::COL_NO_HP,15)->nullable();
            $table->unsignedInteger(\App\UserData::COL_TEMPAT_LAHIR)->nullable();
            $table->date(\App\UserData::COL_TANGGAL_LAHIR)->nullable();
            $table->string(\App\UserData::COL_ALAMAT_JALAN)->nullable();
            $table->unsignedInteger(\App\UserData::COL_ALAMAT_KECAMATAN)->nullable();
            $table->string(\App\UserData::COL_ALAMAT_JALAN_DOMISILI)->nullable();
            $table->unsignedInteger(\App\UserData::COL_ALAMAT_KECAMATAN_DOMISILI)->nullable();
            $table->unsignedSmallInteger(\App\UserData::COL_JENJANG_PENDIDIKAN)->nullable();
            $table->timestamps();
            $table->integer('riwayat_pendidikan')->unsigned()->default(0);
            
            $table->foreign(MyHelper::ColName(\App\UserData::COL_ID))->references(MyHelper::ColName(\App\User::COL_ID))->on(\App\User::TABLE)->onDelete('cascade');
            $table->primary(MyHelper::ColName(\App\UserData::COL_ID));
            $table->foreign(MyHelper::ColName(\App\UserData::COL_TEMPAT_LAHIR))->references(MyHelper::ColName(\App\KotaKab::COL_ID))->on(\App\KotaKab::TABLE);
            $table->foreign(MyHelper::ColName(\App\UserData::COL_ALAMAT_KECAMATAN))->references(MyHelper::ColName(\App\Kecamatan::COL_ID))->on(\App\Kecamatan::TABLE);
            $table->foreign(MyHelper::ColName(\App\UserData::COL_ALAMAT_KECAMATAN_DOMISILI))->references(MyHelper::ColName(\App\Kecamatan::COL_ID))->on(\App\Kecamatan::TABLE);
            $table->foreign(MyHelper::ColName(\App\UserData::COL_JENJANG_PENDIDIKAN))->references(MyHelper::ColName(\App\JenjangPendidikan::COL_ID))->on(\App\JenjangPendidikan::TABLE);
            //$table->foreign(MyHelper::ColName(\App\UserData::COL_RIWAYAT_PENDIDIKAN))->references(MyHelper::ColName(\App\JenjangPendidikan::COL_ID))->on(\App\JenjangPendidikan::TABLE);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\UserData::TABLE);
    }
}
