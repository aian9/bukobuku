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
use App\MataPelajaranGuru;
use App\Tagihan;
use App\Pembayaran;
use Carbon\Carbon;
use Validator;

class DetailOrder_controller extends Controller
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

        $this->model = new OrderDate();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'keterangan' => 'max:255',
            'id_order' => 'required|numeric|min:1'
        ], [
            'date.required' => 'Tanggal Harus Diisi',
            'id_order.required' => 'Pilih Order Dulu',
            'id_order.numeric' => 'Order Harus Valid',
            'id_order.min' => 'Order Harus Valid',
            'date.date' => 'Tanggal Harus Valid',
            'keterangan.max' | 'Keterangan Maksimal 255 Karakter'
        ]);

        // untuk update total di order
        $data = [];
        $total = Order::find($request->id_order);

        $data_total = OrderDate::where('id_order', $request->id_order)->get()->count();
        
        if($data_total>$total->durasi){
            return redirect()->back()->with('error',"error: Jumlah Jadwal Anda Melebihi Jumlah Pertemuan");
        }else{
            $data=array('date' => $request->date,
                    'keterangan' => $request->keterangan,
                    'id_order' => $request->id_order,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => '0');
            
            $insert = OrderDate::insert($data);
            
            if (!$insert) {
                $msg = [
                    'error' => 'Jadwal Gagal Di Buat',
                ];

                return redirect()->back()->with($msg);
            }

            $msg = [
                    'success' => 'Jadwal Sukses Di Buat',
                ];
                
            return redirect()->back()->with($msg);

        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'keterangan' => 'max:255',
            'id_order' => 'required|numeric|min:1'
        ], [
            'date.required' => 'Tanggal Harus Diisi',
            'id_order.required' => 'Pilih Order Dulu',
            'id_order.numeric' => 'Order Harus Valid',
            'id_order.min' => 'Order Harus Valid',
            'date.date' => 'Tanggal Harus Valid',
            'keterangan.max' | 'Keterangan Maksimal 255 Karakter'
        ]);
        
        //var_dump($data); die;
        if ($this->user->tipe_akun == User::TIPE_GURU) {
            $data=array(
                    'keterangan' => $request->keterangan,
                    'id_order' => $request->id_order,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => '2');
        }else{
            $data=array('date' => $request->date,
                    'keterangan' => $request->keterangan,
                    'id_order' => $request->id_order,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => '1');
        }
        
        $update = OrderDate::where($this->model::COL_ID, $request->iddetail)->update($data);

        if (!$update) {
            $msg = [
                'error' => 'Jadwal Gagal Di Ubah',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Jadwal Sukses Di Ubah',
               ];
            
        return redirect()->back()->with($msg); 
    }

    public function accepted($id)
    {   
        // get data detail
        $order = OrderDate::find($id);
        $msg = [];
        if($order->status==3){ // jika sudah disetujui guru 
            $data=array('status' => '4'); // maka kelas berakhir
        }else{
            $data=array('status' => '3'); // jika belum maka disetujui dulu
        }
        try {
            DB::beginTransaction();
            // update dulu detail
            $update = OrderDate::where($this->model::COL_ID, $id)->update($data);

            // get jumlah detail yang ber id order sesuai data->id_order
            $detail = OrderDate::where('id_order', $order->id_order)->where('status', '4')->count();
            // get order untuk mencari total pertemuan
            $total = Order::find($order->id_order);
            
            if($detail==$total->durasi){ // jika detail jadwal dan durasi sama 
                // update order menjadi kelas selesai
                $data=array('status' => '5');
                // update order 
                $update = Order::where(Order::COL_ID, $order->id_order)->update($data);

                // update tagihan 
                $data=array('status' => '3');
                $tagihan = Tagihan::where("id_order", $order->id_order)->where('status', '2')->get();
                $update = Tagihan::where("id", $order->id_order)->update($data);
                
                // update pembayaran
                $data=array('status' => '2');
                $bayar = Pembayaran::where("id_tagihan", $tagihan[0]->id)->where('status', '1')->get();
                $update = Pembayaran::where("id", $bayar[0]->id)->update($data);

                $msg = [
                    'success' => 'Terimakasih, Kelas Telah Selesai',
                ];
            }else{
                $msg = [
                    'success' => 'Jadwal Sukses Di Setujui',
                   ];
            }

            DB::commit();

        }catch (\Exception $e){
            
            return redirect()->back()->with('error', "Error: Jadwal gagal diperbarui");
        }
        
        return redirect()->back()->with($msg);
    }

    public function delete($id)
    {   
        $detail = OrderDate::find($id);

        try{
            DB::beginTransaction();
            // delete detail
            $data = $this->model->find($id);
            $data->delete();
            
            // untuk update total di order
            $data = [];
            
            $order = Order::find($detail["id_order"]);
            $mapel = MataPelajaranGuru::where('id_matpel', $order["id_matpel"])
                                        ->where('id_user', $order["id_guru"])
                                        ->get();
            
            $data_total = OrderDate::where('id_order', $order["id"])->get()->count();
            
            $data = [
                'total' => $mapel[0]["tarif"]*$data_total
            ];
            
            $update = Order::where(Order::COL_ID, $order["id"])->update($data);

            DB::commit();
        }catch (\Exception $e){
            
            echo json_encode("Gagal Menghapus Jadwal");
        }
        
        echo json_encode("Sukses Menghapus Jadwal");
    }
}
