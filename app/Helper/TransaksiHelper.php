<?php
/**
 * Created by PhpStorm.
 * User: anant
 * Date: 1/20/2019
 * Time: 5:24 AM
 */

namespace App\Helper;


use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiHelper
{
    public static function saldo($userid){
        $creditQuery = DB::table(Transaksi::TABLE)->selectRaw('IFNULL(SUM('.Transaksi::COL_NOMINAL.'),0) as credit')
            ->where(Transaksi::COL_ID_USER,'=',$userid)
            ->where(function ($query){
                $query->where(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_TRANSFER);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_DISKON);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_REJECTED);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_ABORTED);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_GURU_HONOR);
            })
            //->whereNotNull(Transaksi::COL_ID_DATA_TRANSFER)
            ->where(Transaksi::COL_STATUS,'=',Transaksi::STATUS_OK);

        $debitQuery = DB::table(Transaksi::TABLE)->selectRaw('IFNULL(SUM('.Transaksi::COL_NOMINAL.'),0) as debit')
            ->where(Transaksi::COL_ID_USER,'=',$userid)
            ->where(Transaksi::COL_TIPE,'=',Transaksi::TIPE_OUT_TRANSFER)
            //->whereNotNull(Transaksi::COL_ID_DATA_TRANSFER)
            ->where(Transaksi::COL_STATUS,'=',Transaksi::STATUS_OK);


        return DB::table(DB::raw("({$creditQuery->toSql()}) as credit, ({$debitQuery->toSql()}) as debit"))
            ->mergeBindings($creditQuery)
            ->mergeBindings($debitQuery)
            ->selectRaw("(credit-debit) as balance")
            ->first()->balance;
    }

    /**
     * @param int $userid
     * @param Carbon $date
     * @return mixed
     */
    public static function saldoTillDate($userid, $date){
        $creditQuery = DB::table(Transaksi::TABLE)->selectRaw('IFNULL(SUM('.Transaksi::COL_NOMINAL.'),0) as credit')
            ->where(Transaksi::COL_ID_USER,'=',$userid)
            ->where(function ($query){
                $query->where(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_TRANSFER);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_DISKON);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_REJECTED);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_ABORTED);
                $query->orWhere(Transaksi::COL_TIPE,'=',Transaksi::TIPE_IN_GURU_HONOR);
            })
            ->whereDate(Transaksi::COL_CREATED_AT,'<=',$date->endOfDay())
            //->whereNotNull(Transaksi::COL_ID_DATA_TRANSFER)
            ->where(Transaksi::COL_STATUS,'=',Transaksi::STATUS_OK);

        $debitQuery = DB::table(Transaksi::TABLE)->selectRaw('IFNULL(SUM('.Transaksi::COL_NOMINAL.'),0) as debit')
            ->where(Transaksi::COL_ID_USER,'=',$userid)
            ->where(Transaksi::COL_TIPE,'=',Transaksi::TIPE_OUT_TRANSFER)
            //->whereNotNull(Transaksi::COL_ID_DATA_TRANSFER)
            ->where(Transaksi::COL_STATUS,'=',Transaksi::STATUS_OK);


        return DB::table(DB::raw("({$creditQuery->toSql()}) as credit, ({$debitQuery->toSql()}) as debit"))
            ->mergeBindings($creditQuery)
            ->mergeBindings($debitQuery)
            ->selectRaw("(credit-debit) as balance")
            ->first()->balance;
    }


}