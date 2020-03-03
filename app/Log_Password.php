<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Log_Password extends Model
{
    protected $fillable = array('id_user', 'email');
    
    protected $table = "log_password";
}
