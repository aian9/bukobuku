<?php

namespace App\Http\Controllers\Admin;

use App\DataTransfer;
use App\Helper\TransaksiHelper;
use App\Pembayaran;
use App\Order;
use App\User;
use App\UserData;
use App\UserStatus;
use App\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Bank;
use Illuminate\Support\Facades\Storage;
use App\Notifikasi;

class Transaksi_Controller extends Controller
{       
    protected $user;

    protected $userdata;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next)
        {   
            $this->user = \Auth::user();
            $this->userdata = DB::table(UserData::TABLE)->join(UserStatus::TABLE,UserData::COL_ID,'=',UserStatus::COL_ID)->where(UserData::COL_ID,'=',$this->user->id)->first();
            
            return $next($request);
        });
        
        $this->model = new Order();
    }

    public function index()
    {
        if($this->user->tipe_akun!=User::TIPE_ADMIN){
            return redirect("dashboard");
        }
        
        $data["data"] = Pembayaran::orderby("id", "desc")->paginate(10);
        $data["bank"] = self::toList(Bank::all()->toArray(), 'id');

        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();
        
        return view('admin.list_transfer', $data);
    }

    public function getById_order($id)
    {   
        $order = Order::find($id);
        $tagihan = Tagihan::where('id_order', $id)->Where('status', '1')->orWhere('status','2')->orderBy("id", "desc")->get();
        $transaksi = Pembayaran::where('id_tagihan', $tagihan[0]["id"])->get();
        
        $data = [];
        $data["kode"] = $order["kode_transaksi"];
        $data["foto"] = asset('storage/uploads/transfer')."/".$transaksi[0]["filepath_bukti"];
        
        return json_encode($data);
    }
}
