<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\UserData;
use App\User;
use App\UserStatus;
use App\Order;
use App\OrderDate;
use App\Provinsi;
use App\Kecamatan;
use App\KotaKab;
use App\Pengaduan;
use App\PengaduanDetail;
use App\Notifikasi;

class Pengaduan_controller extends Controller
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

        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();
        $data["pengaduan"]  = self::Set_toArray(Pengaduan::getList());

        return view('admin.listpengaduan', $data);
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
        // get detail order
        $jadwal             = OrderDate::select()->where('id', $id)->get();

        // get order untuk id user
        $order              = Order::find($jadwal[0]["id_order"]);
        $data["order"]     = $jadwal[0];
        $data["order"]["id_user"]        = $order["id_murid"];
        $data["order"]["kode_transaksi"] = $order["kode_transaksi"];
        // get pengaduan berdasarkan id detail order
        $pengaduan          = Pengaduan::where("id_jadwal", $id)->get()->toArray();

        if (count($pengaduan)>0) {
            $data["pengaduan"]  = $pengaduan;
            // get detail pengaduan
            $data["detail"]     = PengaduanDetail::where("id_pengaduan", $pengaduan[0]["id"])->get()->toArray();
        }
        
        

        return view('user.pengaduan', $data);
    }

    public function store(Request $request)
    {   
        $this->validate($request,[
            'id_jadwal' => 'required|numeric',
            'pesan' => 'required|min:10|max:100'
        ],[
            'email.required' => "Order Harus Valid",
            'email.numeric' => "Order Harus Valid",
            'pesan.required' => "Pesan harus diisi",
            'pesan.min' => "Pesan di isi minimal 10 karakter",
            'pesan.max' => "Pesan di isi maksimal 100 karakter"
        ]);

        try { 
            DB::beginTransaction();

            $pengaduan            = new Pengaduan();
            $pengaduan->id_jadwal = $request->id_jadwal;
            $pengaduan->pengaduan = $request->pesan;
            $id = $pengaduan->save();

            // Untuk memberikan notifikasi ketika ada pengaduan
            $notif                 = new Notifikasi();
            $notif->id_user        = $this->user->id;
            $notif->link           = url('admin/pengaduan/');
            $notif->is_admin       = "0";
            $notif->ket            = $request->pesan;
            $notif->status         = "0";
            $notif->save();

            DB::commit();

        } catch (Exception $e) {

            return redirect()->back()->with('error',"Error: Gagal Menyampaikan Pengaduan");
        }

        return redirect()->back()->with('success',"success: Sukses Membuat Pengaduan, Mohon Ditunggu Jawaban Dari CS Kami ^_^");
    }

    public function detail($id)
    {   
        $data               = [];
        $data["userdata"]   = $this->userdata;
        $pengaduan          = Pengaduan::find($id);
        // get detail order
        $jadwal             = OrderDate::select()->where('id', $pengaduan["id_jadwal"])->get();
        
        $order              = Order::find($jadwal[0]["id_order"]);
        $data["pengaduan"]  = $pengaduan;
        $data["detail"]     = PengaduanDetail::where("id_pengaduan", $id)->get();
        $data["data"]       = User::find($order["id_murid"]);

        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        return view('admin.pengaduandetail', $data);
    }

    public function detailAct(Request $request)
    {
        $this->validate($request,[
            'jawaban' => 'required|min:10|max:100',
            'pengaduan' => 'required|numeric'
        ],[
            'jawaban.required' => "Jawaban Harus Di isi",
            'jawaban.min' => "Jawaban di isi minimal 10 karakter",
            'jawaban.max' => "Jawaban di isi maksimal 100 karakter",
            'pengaduan.request' => "Pengaduan Harus Di Isi",
            'pengaduan.numeric' => "Pengaduan Harus Di Isi dengan valid"
        ]);

        try { 
            DB::beginTransaction();

            $detail                 = new PengaduanDetail();
            $detail->id_pengaduan   = $request->pengaduan;
            $detail->jawaban        = $request->jawaban;
            $detail->id_user        = $this->user->id;
            $detail->is_admin       = "0";
            if ($this->user->tipe_akun==10) {
               $detail->is_admin    = "1";
            }

            $detail->save();

            // Untuk memberikan notifikasi ketika ada pengaduan
            $notif                 = new Notifikasi();
            $notif->id_user        = $this->user->id;
            $notif->link           = url('admin/pengaduan/detail/'.$detail->id_pengaduan);
            $notif->is_admin       = $detail->is_admin;
            $notif->ket            = $request->jawaban;
            $notif->status         = "0";
            $notif->save();

            //self::sendEmail($notif);

            DB::commit();

        } catch (Exception $e) {

            return redirect()->back()->with('error',"Error: Gagal Menjawab Pengaduan");
        }

        return redirect()->back()->with('success',"success: Sukses Menjawab Pengaduan");

    }

    public function setNotif($id)
    {
        $data = Notifikasi::find($id);

        $notif = array('status' => "1");
        Notifikasi::where("id", $id)->update($notif);

        return redirect($data["link"]);
    }

    public function sendEmail($data)
    {   

        try {
            $user = User::where('email', $req->email)->get()->toArray();

            $link = route('forgotten.confirm')."/".Crypt::encryptString($user[0]["id"]);

            \Mail::to($user[0]['email'])->send(new \App\Mail\ForgotMail($link));

        } catch (Exception $e) {

         return redirect()->back()->with('error',"Error: Gagal membuat akun ");
        }
        
        return redirect()->back()->with('success',"success: Silahkan Cek Email Anda");
    }
}
