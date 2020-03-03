<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notifikasi;
use DB;

class Dashboard_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index()
    {	
    	// untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();
        $data["jumlah_siswa"]   = DB::select("select COUNT(id) as hitung from users where tipe_akun=1");
        $data["jumlah_guru"]    = DB::select("select COUNT(id) as hitung from users where tipe_akun=2");
        $data["jumlah_pesanan"] = DB::select("select COUNT(id) as hitung from `order`");
        $data["jumlah_selesai"] = DB::select("select COUNT(id) as hitung from `order` where status=5");

        return view('admin.dashboard', $data);
    }
}
