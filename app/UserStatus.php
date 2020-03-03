<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserStatus extends Model
{   
    
    const TABLE = "user_status";
    const COL_ID = UserStatus::TABLE.".id";
    const COL_NOT_ACTIVATED_ACCOUNT = UserStatus::TABLE.".not_activated";
    const COL_SUSPENDED_ACCOUNT = UserStatus::TABLE.".suspended";
    const COL_EMAIL_ACTIVATED = UserStatus::TABLE.".email_activated";
    const COL_VERIFIED_PROFILE = UserStatus::TABLE.".verified_profile";
    const COL_ACCEPTED_TEACHER = UserStatus::TABLE.".accepted_teacher";
    const COL_CREATED_AT = UserStatus::TABLE.".created_at";
    const COL_UPDATED_AT = UserStatus::TABLE.".updated_at";

    protected $table = UserStatus::TABLE;
    
}
