<?php
/**
 * Created by PhpStorm.
 * User: anant
 * Date: 12/24/2018
 * Time: 2:23 PM
 */

namespace App;


class MyHelper
{
    public static function ColName($col){
        $colarr = explode(".", $col);
        if (count($colarr)>1)
            return $colarr[1];
        else
            return $col;
    }
}