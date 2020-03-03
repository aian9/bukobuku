<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Paginator;

class Order extends Model
{
    const TABLE = "order";
    const COL_ID = Order::TABLE.".id";
    const COL_ID_GURU = Order::TABLE.".id_guru";
    const COL_ID_MURID = Order::TABLE.".id_murid";
    const COL_ID_MATPEL = Order::TABLE.".id_matpel";
    const COL_KETERANGAN = Order::TABLE.".keterangan";
    const COL_TRANSAKSI = Order::TABLE.".transaksi";
    const COL_ID_KODE_PROMO = Order::TABLE.".id_kode_promo";
    const COL_STATUS = Order::TABLE.".status";
    const COL_NOMINAL = Order::TABLE.".nominal";
    const COL_CREATED_AT = Order::TABLE.".created_at";
    const COL_UPDATED_AT = Order::TABLE.".updated_at";

    const STATUS_DATE_UNAVAILABLE = -6;
    const STATUS_GURU_REJECTED = -5;
    const STATUS_GURU_ABSENT_VERIFIED = -4;
    const STATUS_GURU_ABSENT_WAIT = -3;
    /** Jika pesanan berhasil dibatalkan dan selesai pengembalian dana */
    const STATUS_ABORTED_DONE = -2;
    /** Jika pesanan berhasil dibatalkan dan belum selesai pengembalian dana */
    const STATUS_ABORTED = -1;
    const STATUS_WAITING_PAYMENT = 0;
    const STATUS_BALANCE_NOT_SUFFICIENT = 1;
    const STATUS_PAYMENT_VERIFIED = 2;
    const STATUS_GURU_ACCEPTED = 3;
    const STATUS_DONE = 4;

    protected $table = Order::TABLE;
    //protected $with = ['matpel','guru','murid'];

    public function statusText(){
        switch ($this->status){
            case self::STATUS_DATE_UNAVAILABLE :
                return "Tanggal tidak tersedia";
            case self::STATUS_GURU_REJECTED :
                return "Pesanan ditolak guru";
            case self::STATUS_GURU_ABSENT_WAIT :
                return "Guru tidak menghadiri kelas";
            case self::STATUS_GURU_ABSENT_VERIFIED :
                return "Guru tidak menghadiri kelas";
            case self::STATUS_ABORTED_DONE :
                return "Pesanan dibatalkan";
            case self::STATUS_ABORTED :
                return "Pesanan dibatalkan";
            case self::STATUS_WAITING_PAYMENT :
                return "Menunggu pembayaran";
            case self::STATUS_BALANCE_NOT_SUFFICIENT :
                return "Saldo tidak mencukupi";
            case self::STATUS_PAYMENT_VERIFIED :
                return "Pembayaran sudah diverifikasi";
            case self::STATUS_GURU_ACCEPTED :
                return "Pesanan diterima guru";
            case self::STATUS_DONE :
                return "Pembelajaran telah dilakukan";
        }
    }

    public function matpel(){
        return $this->belongsTo('App\MataPelajaran', MyHelper::ColName(Order::COL_ID_MATPEL),MyHelper::ColName(MataPelajaran::COL_ID));
    }

    public function guru(){
        return $this->belongsTo('App\User', MyHelper::ColName(Order::COL_ID_GURU),MyHelper::ColName(User::COL_ID))
            ->join(\App\UserData::TABLE,\App\User::COL_ID,'=',\App\UserData::COL_ID)
            ->join(\App\UserStatus::TABLE,\App\User::COL_ID,'=',\App\UserStatus::COL_ID);
    }

    public function murid(){
        return $this->belongsTo('App\User', MyHelper::ColName(Order::COL_ID_MURID),MyHelper::ColName(User::COL_ID))
            ->join(\App\UserData::TABLE,\App\User::COL_ID,'=',\App\UserData::COL_ID)
            ->join(\App\UserStatus::TABLE,\App\User::COL_ID,'=',\App\UserStatus::COL_ID);
    }

    public function order_dates(){
        return $this->hasMany('App\OrderDate',MyHelper::ColName(OrderDate::COL_ID_ORDER), MyHelper::ColName(Order::COL_ID))->orderBy(OrderDate::COL_DATETIME);
    }

    public function konfirmasi_pembayaran(){
        return $this->hasMany('App\KonfirmasiPembayaran',MyHelper::ColName(KonfirmasiPembayaran::COL_ID_ORDER),MyHelper::ColName(Order::COL_ID));
    }

    public function review(){
        return $this->hasOne('App\Review',MyHelper::ColName(Review::COL_ID_ORDER),MyHelper::ColName(Order::COL_ID));
    }

    public function nominal_discounted(){
        /** @var Promo|KodePromo $promo */
        $promo = \DB::table(KodePromo::TABLE)->join(Promo::TABLE,KodePromo::COL_ID_PROMO,'=',Promo::COL_ID)
            ->where(KodePromo::COL_ID,'=',$this->id_kode_promo)
            ->first();
        
        if (empty($promo))
            return $this->nominal;
        
        $nominalPromo = $promo->persentase * $this->nominal;
        
        if ($nominalPromo >= $promo->max_promo)
            return $this->nominal - $promo->max_promo;
        return $this->nominal - $nominalPromo;
    }

    public function no_invoice(){
        $bln = [1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'];


        return preg_split('/\ /',$this->created_at)[0].'-'.$this->id;
    }

    public static function generateCode($idguru, $idmatpel)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
    
        for ($i = 0; $i < 8; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        
        return $randomString;
    }

    public static function getListOrder($iduser, $tipe)
    {
        $data = [];
        if($tipe==2){
            $data = DB::table("order as o")
                    ->select("o.id", "o.kode_transaksi", "o.id_guru", "o.id_murid", "o.id_matpel", "o.durasi", "o.id_kode_promo", "o.status", "o.keterangan", "o.total", "o.created_at", "o.updated_at", "m.nama")
                    ->join("mata_pelajaran as m", "o.id_matpel","m.id")
                    ->where("o.id_guru","=", $iduser)
                    ->orderBy("o.id", "desc")
                    ->paginate(5);

        }else if($tipe==1){
            $data = DB::table("order as o")
                    ->select("o.id", "o.kode_transaksi", "o.id_guru", "o.id_murid", "o.id_matpel", "o.durasi", "o.id_kode_promo", "o.status", "o.keterangan", "o.total", "o.created_at", "o.updated_at", "m.nama")
                    ->join("mata_pelajaran as m", "o.id_matpel","m.id")
                    ->where("o.id_murid","=", $iduser)
                    ->orderBy("o.id", "desc")
                    ->paginate(5);
        }

        return $data;
    }
}
