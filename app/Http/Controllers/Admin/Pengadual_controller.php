<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\UserData;
use App\User;
use App\UserStatus;
use App\Order;
use App\Provinsi;
use App\Kecamatan;
use App\KotaKab;

class Pengadual_controller extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next)
        {   
            $this->user = \Auth::user();
            $this->userdata = DB::table(UserData::TABLE)->join(UserStatus::TABLE,UserData::COL_ID,'=',UserStatus::COL_ID)->where(UserData::COL_ID,'=',$this->user->id)->first();
            
            return $next($request);
        });
    }

    public function index()
    {   
        if ($this->user->tipe_akun!=10) {
            return redirect()->back();
        }

        return view('user.pembayaran', $data);
    }

    public function pengaduan($id)
    {   
        $data               = [];
        $data["data"]       = User::getListUserDefine('2');
        $data["provinsi"]   = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"]       = $this->user;
        $data["userdata"]   = $this->userdata;
        $data["kota"]       = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"]  = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $order              = Order::select()->where('kode_transaksi', $id)->get();
        $data["order"]      = $order[0];

        return view('user.pengaduan', $data);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        
    }
}
