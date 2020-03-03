<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifikasi;
use App\Order;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $hari = [];
    public $jam = [];
    public $durasi = [];

    public function edit($id)
    {
        $data = $this->model->find($id);
        
        return json_encode($data);
    }

    public function destroy($id)
    {
        $data = $this->model->find($id);
        $data->delete();
        
        return response()->json($data);
    }

    public function toList($data, $id)
    {   
        $a_data = [];
        // echo "<pre>";
        // var_dump($data); die;
        foreach ($data as $key => $value) {
                $a_data[$value[$id]] = $value;
        }

        return $a_data;
    }
    
    public function Set_toArray($data)
    {   
        $a_data = json_decode(json_encode($data), true);

        return $a_data;
    }

    public function sendNotifikasi($data)
    {
        // Untuk memberikan notifikasi ketika ada aksi
        $notif                 = new Notifikasi();
        $notif->id_user        = $data["id_user"];
        $notif->link           = $data["url"];
        $notif->is_admin       = "0";
        $notif->ket            = $data["pesan"];
        $notif->status         = "0";
        $notif->save();
    }
}
