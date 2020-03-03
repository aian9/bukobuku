<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    const TABLE = "data_guru";
    const COL_ID = DataGuru::TABLE.".id";
    const COL_RIWAYAT_PENDIDIKAN = DataGuru::TABLE.".riwayat_pendidikan";
    const COL_CREATED_AT = DataGuru::TABLE.".created_at";
    const COL_UPDATED_AT = DataGuru::TABLE.".updated_at";
    protected $table = DataGuru::TABLE;

    

    public static function getListGuru($data)
    {
    	$sql = "select u.id,u.email,d.jenis_kelamin,u.username,u.created_at,u.tipe_akun,
                d.no_identitas,d.nama_lengkap,d.nama_panggilan, d.no_hp,d.tempat_lahir,
                d.tanggal_lahir,d.alamat_jalan,d.alamat_kota,d.deskripsi,d.link,
                d.alamat_jalan_domisili, d.alamat_kota_domisili,
                d.jenjang_pendidikan,s.verified_profile from users u
                join user_data d on u.id=d.id 
                join user_status s on u.id=s.id 
                join mata_pelajaran_guru m on u.id=m.id_user
                join jadwal_guru j on j.id_user=u.id
                join kota_kab b on d.alamat_kota_domisili=b.kode_kota
                where u.tipe_akun='2' and 
                (b.kode_kota='".$data["id_kota"]."' or m.id_matpel='".$data["mapel"]."' or j.time='".$data["jam"]."' or m.id_bidang='".$data["id_bidang"]."')
                and (s.email_activated !='0' and s.verified_profile='1' and s.accepted_teacher='1' and s.suspended='0')
                group by u.id,u.email,d.jenis_kelamin,u.username,u.created_at,u.tipe_akun,
                d.no_identitas,d.nama_lengkap,d.nama_panggilan, d.no_hp,d.tempat_lahir,
                d.tanggal_lahir,d.alamat_jalan,d.alamat_kota,
                d.alamat_jalan_domisili, d.alamat_kota_domisili,
                d.jenjang_pendidikan,s.verified_profile, d.deskripsi, d.link, d.alamat_kota_domisili, d.jenjang_pendidikan,s.verified_profile";
        
        $a_data = DB::select($sql);
        
        return $a_data;
    }
}
