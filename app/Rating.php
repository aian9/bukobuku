<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    const TABLE = 'rating';

    protected $table = "rating";

    public static function OrderList()
    {
        $data = DB::table("rating")->get()->toArray();

        $a_data = [];
        foreach($data as $key => $val){
            $a_data[$val->id_order] = $val;
        }

        return $a_data;
    }

    public static function GuruList()
    {
        $data = DB::select(DB::raw("select id_guru, ROUND(avg(rating)) as rating from rating group by id_guru"));

        $a_data = [];
        foreach($data as $key => $val){
            $a_data[$val->id_guru] = $val;
        }

        return $a_data;
    }
}
