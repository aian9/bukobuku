<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\UserData;
use App\User;
use App\UserStatus;
use App\Order;
use App\MataPelajaran;
use App\Tagihan;
use App\Pembayaran;
use File;
use Illuminate\Support\Facades\Response as FacadeResponse;
use App\Notifikasi;

class Order_controller extends Controller
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
        
        $data["user"] = self::toList(UserData::all()->toArray(), "id");
        $data["data"] = Order::orderBy('id', 'DESC')->paginate(10);
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), "id");
        
    return view('admin.order_verification', $data);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_matpel' => 'required|numeric|min:1',
            'id_guru' => 'required|numeric|min:1',
            'keterangan' => 'max:255',
            'durasi' => 'max:10|required'
        ], [
            'id_matpel.required' => "Mata Pelajaran harus diisi",
            'id_matpel.numeric' => "Mata Pelajaran Harus Valid",
            'id_guru.required' => "Guru Harus diisi",
            'id_guru.numeric' => "Guru Harus Valid",
            'keterangan.max' => "Maksimal 255 Karakter",
            'durasi.max' => "Maksimal 10 Karakter",
            'durasi.required' => "Durasi Harus Di isi"
        ]);
        
        try {
            DB::beginTransaction();

            $order = new Order();
            $order->id_matpel = $request->id_matpel;
            $order->id_guru = $request->id_guru;
            $order->id_murid = $this->user->id;
            $order->keterangan = $request->keterangan;
            $order->durasi = $request->durasi;
            $order->kode_transaksi = Order::generateCode($request->id_guru, $request->id_matpel);
            $order->status = '0';
            $order->total = $request->total;
            $order->save();


            // untuk notifikasi
            $admin = User::select("id")->where("tipe_akun", "10")->get()->toArray();
            $user = self::toList(User::select("id", "email", "tipe_akun")->get()->toArray(), "id");
            $userdata = self::toList(UserData::select("id", "nama_lengkap")->get()->toArray(), "id");

            $data = array('id_murid' => $order->id_murid,
                            'id_guru' => $order->id_guru,
                            'id_admin' =>  $admin[0]["id"]);

            // foreach notifikasi untuk semua user (murid, guru, admin)
            foreach ($data as $key => $value) {
                    $link = array('link' => route('user.dashboard.listorder'),
                                'subject' => 'Pemberitahuan Order');

                if ($user[$value]["tipe_akun"]==1) {

                    $link["deskripsi"] = "Anda Meminta Guru ".$userdata[$order->id_guru]["nama_lengkap"]." Untuk Membimbing Belajar. Mohon Ditunggu persetujuan dari guru ^_^";
                    
                    $notif                 = new Notifikasi();
                    $notif->id_user        = $value;
                    $notif->link           = $link["link"];
                    $notif->is_admin       = "0";
                    $notif->ket            = $link["deskripsi"];
                    $notif->status         = "0";
                    $notif->save();
                    
                    $email = $user[$value]["email"];

                   \Mail::to($email)->send(new \App\Mail\NotifikasiOrder($link));
                }else if($user[$value]["tipe_akun"]==2){

                    $link["deskripsi"] = "Anda Diminta Murid ".$userdata[$order->id_murid]["nama_lengkap"]." Untuk Membimbing Belajar. Mohon Disetujui ^_^";

                    $notif                 = new Notifikasi();
                    $notif->id_user        = $value;
                    $notif->link           = $link["link"];
                    $notif->is_admin       = "0";
                    $notif->ket            = $link["deskripsi"];
                    $notif->status         = "0";
                    $notif->save();

                     $email = $user[$value]["email"];

                    \Mail::to($email)->send(new \App\Mail\NotifikasiOrder($link));
                }else if($user[$value]["tipe_akun"]==10){

                    $link                  = [];
                    $link = array('link' => route('admin.listorder'),
                                'subject' => 'Pemberitahuan Order');

                    $link["deskripsi"] = "Murid ".$userdata[$order->id_murid]["nama_lengkap"]." Meminta Guru ".$userdata[$order->id_guru]["nama_lengkap"]." Untuk Membimbing Belajar.";

                    $notif                 = new Notifikasi();
                    $notif->id_user        = $value;
                    $notif->link           = $link["link"];
                    $notif->is_admin       = "1";
                    $notif->ket            = $link["deskripsi"];
                    $notif->status         = "0";
                    $notif->save();

                     $email = $user[$value]["email"];

                    \Mail::to($email)->send(new \App\Mail\NotifikasiOrder($link));
                }
            }
            
            DB::commit();
        }catch (\Exception $e){
            $msg = [
                'error' => 'Error: Order Guru Gagal',
            ];
            
            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Order Guru Sukses',
            ];
        
        return redirect(route('user.dashboard.order'))->with($msg);
    }
    
    public function accepted($id)
    {   
        $data=array('status' => '1');
        
        $update = Order::where(Order::COL_ID, $id)->update($data);
        $order  = Order::find($id);
        $guru   = UserData::find($order->id_guru);
        $murid  = User::find($order->id_murid);

        $link = array('link' => url('admin/listorder/detail/'.$order->kode_transaksi),
                        'subject' => 'Guru Menyetujui',
                        'deskripsi' => 'Guru '.$guru->nama_lengkap.'Menyetujui Order Anda');

        $notif                 = new Notifikasi();
        $notif->id_user        = $order->id_murid;
        $notif->link           = $link["link"];
        $notif->is_admin       = "0";
        $notif->ket            = $link["deskripsi"];
        $notif->status         = "0";
        $notif->save();
        
        $email = $murid->email;
        
        \Mail::to($email)->send(new \App\Mail\NotifikasiOrder($link));
        
        if (!$update) {
            $msg = [
                'error' => 'Order Gagal Di Setujui',
               ];

            return redirect()->back()->with($msg);
        }
        
        $msg = [
                'success' => 'Order Sukses Di Setujui',
               ];
        
        return redirect()->back()->with($msg);
    }

    public function approve($id)
    {   
        $order = Order::find($id); // get order
        $tagihan = Tagihan::where('id_order', $id)->where('status', '1')->get(); // get tagihan
        $transaksi = Pembayaran::where('id_tagihan', $tagihan[0]["id"])->get(); // get transaksi

        if($order["status"]==3){
            try {
                DB::beginTransaction();

                // update order
                $data=array('status' => '4');
            $update = Order::where(Order::COL_ID, $id)->update($data);

                // update tagihan
                $data=array('status' => '2');
                $update = Tagihan::where("id", $tagihan[0]["id"])->update($data);

                // update pembayaran
                $data=array('status' => '1');
                $update = Pembayaran::where(Pembayaran::COL_ID, $transaksi[0]["id"])->update($data);

                DB::commit();
            }catch (\Exception $e){
                $msg = [
                    'error' => 'Error: Order Gagal Di Approve',
                ];

                return redirect()->back()->with($msg);
            }

            $msg = [
                    'success' => 'Success: Order Sukses Di Approve',
                ];
            
        }else {
            $msg = [
                'error' => 'Error: Konfirmasi Dulu Pembayaran Anda',
            ];   
        }

        return redirect()->back()->with($msg);
    }

    public function cancel($id)
    {   
        $order = Order::find($id); // get order
        $tagihan = Tagihan::where('id_order', $id)->where('status', '1')->get(); // get tagihan
        $transaksi = Pembayaran::where('id_tagihan', $tagihan[0]["id"])->get(); // get transaksi

        if($order["status"]==3){
            try {
                DB::beginTransaction();

                // update order
                $data=array('status' => '-1');
                $update = Order::where(Order::COL_ID, $id)->update($data);

                // update tagihan
                $data=array('status' => '-1');
                $update = Tagihan::where("id", $tagihan[0]["id"])->update($data);

                // update pembayaran
                $data=array('status' => '-1');
                $update = Pembayaran::where(Pembayaran::COL_ID, $transaksi[0]["id"])->update($data);

                DB::commit();
            }catch (\Exception $e){
                $msg = [
                    'error' => 'Error: Order Gagal Cancel Order',
                ];

                return redirect()->back()->with($msg);
            }

            $msg = [
                    'success' => 'Success: Order Sukses Cancel Order',
                ];
            
        }else {
            $msg = [
                'error' => 'Error: Konfirmasi Dulu Pembayaran Anda',
            ];   
        }

        return redirect()->back()->with($msg);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function displayImage($filename)
    {
        $filename = "4-1561538952.jpeg";

        $path = storage_path('uploads/transfer/' . $filename);
        
        if (!File::exists($path)) {

            abort(404);

        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($path, 200);

        $response->header("Content-Type", $type);
        
        return $response;
    }
}
