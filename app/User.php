<?php

namespace App;

use DB;
use Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Pagination\Paginator;

class User extends Authenticatable
{
    const TABLE = "users";
    const COL_ID =  User::TABLE.".id";
    const COL_EMAIL = User::TABLE.".email";
    const COL_USERNAME = User::TABLE.".username";
    const COL_PASSWORD = User::TABLE.".password";
    const COL_STATUS = User::TABLE.".status";
    const COL_TIPE_AKUN = User::TABLE.".tipe_akun";
    const COL_EMAIL_VERIFIED_AT = User::TABLE.".email_verified_at";
    const COL_REMEMBER_TOKEN = User::TABLE.".remember_token";
    const COL_CREATED_AT = User::TABLE.".created_at";
    const COL_UPDATED_AT = User::TABLE.".updated_at";

    protected $table = User::TABLE;
    public const TIPE_MURID=1;
    public const TIPE_GURU=2;
    public const TIPE_ADMIN=10;
    
    use Notifiable;

    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getListUserDefine($tipe, $verify = null)
    {   
        $sql = DB::table("users as u")
                        ->select("*", "u.id as id", "u.email as email")
                        ->join('user_data as d', 'u.id', '=', 'd.id')
                        ->join('user_status as s', 'u.id', '=', 's.id')
                        ->join('jenjang_pendidikan as j', 'd.id', '=', 'j.id')
                        ->where("s.email_activated" ,"!=","0")
                        ->paginate(10);

        if ($tipe != null) {
            $sql = DB::table("users as u")
                        ->select("*", "u.id as id", "u.email as email")
                        ->leftjoin('user_data as d', 'u.id', '=', 'd.id')
                        ->leftjoin('user_status as s', 'u.id', '=', 's.id')
                        ->leftjoin('jenjang_pendidikan as j', 'd.id', '=', 'j.id')
                        ->where("s.email_activated" ,"!=","0")
                        ->where("u.tipe_akun" ,"=", $tipe)
                        ->paginate(10);
        }

        if ($verify!=0) {
            $sql = DB::table("users as u")
                        ->select("*", "u.id as id", "u.email as email")
                        ->leftjoin('user_data as d', 'u.id', '=', 'd.id')
                        ->leftjoin('user_status as s', 'u.id', '=', 's.id')
                        ->leftjoin('jenjang_pendidikan as j', 'd.id', '=', 'j.id')
                        ->where("s.email_activated" ,"!=","0")
                        ->where("u.tipe_akun" ,"=", $tipe)
                        ->where("s.accepted_teacher" ,"=", "1")
                        ->paginate(10);
        }

        return $sql;
    }
}
