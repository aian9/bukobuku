<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tagihan;
use App\Pembayaran;
use App\Order;
use App\User;
use App\UserData;
use DB;
use App\UserStatus;
use App\Bank;
use App\Notifikasi;
use App\RekeningSapaGuru;

class Tagihan_controller extends Controller
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
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        $data["data"] = Tagihan::orderby("id", "desc")->paginate(10);
        $data["bank"] = self::toList(Bank::all()->toArray(), 'id');
        $data["order"] = self::toList(Order::all()->toArray(), 'id');
        $data["user"] = self::toList(UserData::all()->toArray(), 'id');

        return view("admin.listtagihan", $data);
    }

    public function bayar(Request $request)
    {   
        $this->validate($request, [
            'metode' => 'required|numeric|min:1',
            'bank' => 'required|numeric|min:1',
            'id_order' => 'required|numeric|min:1'
        ]); 
        
        try{
            $order = Order::find($request->id_order);
            DB::beginTransaction();

            // untuk insert ke tagihan
            $tagihan = new Tagihan();
            $tagihan->id_order = $order->id;
            $tagihan->id_user = $order->id_murid;
            $tagihan->nominal = $order->total;
            $tagihan->metode = $request->metode;
            $tagihan->id_bank = $request->bank;
            $tagihan->keterangan = "Tagihan Order ".$order["kode_transaksi"]." Tanggal ".date("Y-m-d H:i:s");
            $tagihan->status = "0";
            $tagihan->create_date = date("Y-m-d H:i:s");
            $tagihan->expired_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($tagihan->create_date)));
            $tagihan->updated_at = date("Y-m-d H:i:s");
            $tagihan->created_at = date("Y-m-d H:i:s");
            $tagihan = $tagihan->save();
            
            // update status di order setelah generate tagihan
            $data = ['status'=>'2'];
            $update = Order::where(Order::COL_ID, $request->id_order)->update($data);

            // Notifikasi tagihan ke siswa
            $bank       = self::toList(Bank::select("id", "kode_bank", "nama_bank")->get()->toArray(), "id");
            $sapaguru   = self::toList(RekeningSapaGuru::select("id", "kode_bank","no_rekening", "nama")->get()->toArray(), "kode_bank");
            
            // array link deskripsi dan subject email
            $link              = [];
            $link["link"]      = url('user/listorder/pembayaran/'.$order->kode_transaksi);
            $link["subject"]   = "Tagihan Order ".$order->kode_transaksi;

            $link["deskripsi"] = "Anda Telah Membuat Tagihan Sebesar Rp.".$order->total.
                                ". Segera Transfer Ke Rekening ".$bank[$request->bank]["nama_bank"].
                                " No Rekening : ".$sapaguru[$bank[$request->bank]["kode_bank"]]["no_rekening"]." Atas Nama : "
                                .$sapaguru[$bank[$request->bank]["kode_bank"]]["nama"]." Sebelum ".$tagihan["expired_date"];

            // save notifikasi untuk murid
            $notif                 = new Notifikasi();
            $notif->id_user        = $order->id_murid;
            $notif->link           = $link["link"];
            $notif->is_admin       = "0";
            $notif->ket            = $link["deskripsi"];
            $notif->status         = "0";
            $notif->save();

            \Mail::to($this->user->email)->send(new \App\Mail\NotifikasiOrder($link));

            // save notifikasi untuk Admin
            $admin                  = User::select("id")->where("tipe_akun", "10")->first();
            $notif1                 = [];
            $notif1                 = new Notifikasi();
            $notif1->id_user        = $admin->id;
            $notif1->link           = route("admin.listtagihan");
            $notif1->is_admin       = "1";
            $notif1->ket            = "Siswa ".$this->userdata->nama_lengkap." Membuat Tagihan Rp."
                                        .$order->total." Untuk Order ".$order->kode_transaksi;
            $notif1->status         = "0";
            $notif1->save();
            
            DB::commit();
        }catch (\Exception $e){
            $msg = [
                'error' => 'Pembuatan Tagihan Pembayaran Gagal Dibuat ',
            ];
            
            return redirect()->back()->with($msg);
        }

        $msg = [
            'success' => 'Pembuatan Tagihan '.$order->kode_transaksi.' Berhasil',
        ];
        
        return redirect()->back()->with($msg);
    }


    public function konfirmasi(Request $request)
    {   
        $this->validate($request, [
            'norek' => 'required|numeric|min:10',
            'nama' => 'required|min:3|max:255',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_tagihan' => 'min:1|required|numeric'
        ], [
            'norek.required' => "No Rekening harus diisi",
            'norek.numeric' => "No Rekening Tidak Valid",
            'norek.min' => "No Rekening Minimal 10 Karakter",
            'norek.max' => "No Rekening Maksimal 16 Karakter",
            'nama.required' => "Nama Rekening Harus diisi",
            'nama.min' => "Nama Rekening Minimal 3 Karakter",
            'nama.max' => "Nama Rekening Tidak Valid",
            'bukti.required' => "File Bukti Transfer Harus Diisi",
            'bukti.min' => "File Bukti Minimal 10 Kb",
            'bukti.min' => "File Bukti Maksimal 2 Mb",
            'id_tagihan.required' => "Tagihan Harus Ada",
            'id_tagihan.numeric' => "Tagihan Harus Valid",
            'id_tagihan.min' => "Tagihan Harus Valid"
        ]);

        $tagihan = Tagihan::find($request->id_tagihan);
        try{
            DB::beginTransaction();
            $id = $this->user->id."-".time().'.'.request()->bukti->getClientOriginalExtension();
            
            // insert ke pembayaran
            $bayar = new Pembayaran();
            $bayar->id_tagihan = $tagihan->id;
            $bayar->id_bank = $tagihan->id_bank;
            $bayar->nama = $request->nama;
            $bayar->no_rekening = $request->norek;
            $bayar->keterangan = $request->keterangan;
            $bayar->status = '0';
            $bayar->nominal = $tagihan->nominal;
            $bayar->filepath_bukti = $id;
            $bayar->created_at = date("Y-m-d H:i:s");
            $bayar->updated_at = date("Y-m-d H:i:s");
            $bayar->save();
            
            // update status konfirmasi tagihan
            $data = ['status'=>'1'];
            $update = Tagihan::where("id", $tagihan->id)->update($data);
            
            // update status order di konfirmasi
            $data = ['status'=>'3'];
            $update = Order::where("id", $tagihan->id_order)->update($data);
            
            // upload file
            request()->bukti->move('storage/uploads/transfer/', $id);
            
            // array link deskripsi dan subject email
            $order = Order::where("id", $tagihan->id_order)->get();

            $link              = [];
            $link["link"]      = url('user/listorder/pembayaran/'.$order[0]->kode_transaksi);
            $link["subject"]   = "Konfirmasi Pembayaran Order ".$order[0]->kode_transaksi;

            $link["deskripsi"] = "Terimakasih Telah Melakukan Konfirmasi Pembayaran Untuk Tagihan Sebesar Rp.".
                                $tagihan->nominal.". Mohon Menunggu Admin Melakukan Verifikasi Pembayaran Anda ^_^";
            
            // save notifikasi untuk murid
            $notif                 = new Notifikasi();
            $notif->id_user        = $tagihan->id_user;
            $notif->link           = $link["link"];
            $notif->is_admin       = "0";
            $notif->ket            = $link["deskripsi"];
            $notif->status         = "0";
            $notif->save();

            \Mail::to($this->user->email)->send(new \App\Mail\NotifikasiOrder($link));

            // save notifikasi untuk Admin
            $admin                  = User::select("id")->where("tipe_akun", "10")->first();
            $notif1                 = new Notifikasi();
            $notif1->id_user        = $admin->id;
            $notif1->link           = route("admin.listtransaksi");
            $notif1->is_admin       = "1";
            $notif1->ket            = "Siswa ".$this->userdata->nama_lengkap." Melakukan Konfirmasi Pembayaran Sebesar Rp."
                                        .$tagihan->nominal." Untuk Order ".$order[0]->kode_transaksi;
            $notif1->status         = "0";
            $notif1->save();

            DB::commit();
        }
        catch (\Exception $e){

            return redirect()->back()->with('error',"Error: Gagal Upload Konfirmasi Transfer, Mohon Di Periksa Lagi")->withInput();
        }

        return redirect()->back()->with('success','Terimakasih Konfirmasi Bukti Transfer Berhasil ^_^');
    }
}
