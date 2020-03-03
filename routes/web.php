<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Homepage
 */
Route::group(['prefix'=>'/'],function (){
    Route::get('/','Frontend\Dashboard@index')->name('dashboard');
    Route::get('/dashboard','Frontend\Dashboard@index')->name('dashboard');
    Route::get('/about','Frontend\Dashboard@about')->name('about');

    Route::get('/forgot','Frontend\Dashboard@forgot')->name('forgotten');
    Route::post('/forgot/sendEmail','Frontend\Dashboard@sendEmail')->name('forgotten.sendemail');
    Route::get('/forgot/Konfirmasi/{id?}','Frontend\Dashboard@Konfirmasi')->name('forgotten.confirm');
    Route::post('/forgot/Konfirmasi/act','Frontend\Dashboard@Update_password')->name('forgotten.confirm.act');

    Route::post('/getdistrict', 'Frontend\Dashboard@getDistrict')->name('getDistrict');
    Route::get('/seeder', 'Frontend\Dashboard@seeder')->name('seeder');

    // route action untuk list guru
    Route::get('/listguru','Frontend\Dashboard@listguru')->name('listguru');
    Route::get('/listguru/detail/{id}','Frontend\Dashboard@detailguru')->name('dashboard.detailguru');
    Route::post('/listguru','Frontend\Dashboard@listguru')->name('user.dashboard.findguru');
    Route::post('/listguru/gettotal','Frontend\Dashboard@gettotal')->name('user.dashboard.gettotal');
    Route::post('/listguru/rating','Frontend\Dashboard@Rating')->name('admin.listguru.rating');
    Route::get('/listguru/selectmapel/{id}','Frontend\Dashboard@getmapel')->name('dashboard.selectmapel');
    Route::get('/listguru/selectjenjangmapel/{id}','Frontend\Dashboard@getjenjangmapel')->name('dashboard.getjenjangmapel');
    Route::get('/listguru/selectbidangmapel/{id}','Frontend\Dashboard@getbidangmapel')->name('dashboard.getbidangmapel');
    
    // untuk autocomplete
    Route::get('/loadkota','Frontend\Dashboard@loadKota')->name('dashboard.loadKota');
    Route::get('/loadKecamatan','Frontend\Dashboard@loadKecamatan')->name('dashboard.loadKecamatan');
    
    // untuk verifikasi email terbaru
    Route::get('/sendVerifikasi/{id}', 'Frontend\Dashboard@sendVerifikasi')->name('sendverifikasi.email');
    Route::get('/verifikasi/{id}', 'Frontend\Dashboard@verifikasi')->name('verifikasi.email');
});

/**
 * Dashboard user
 */
Route::group(['prefix'=>'user'],function (){
    Route::get('/','User\DashboardUser@index')->name('user.dashboard.index');
    Route::get('/editprofil','User\DashboardUser@editProfile')->name('user.dashboard.edit_profile');
    Route::post('/editprofil','User\DashboardUser@editProfileAct')->name('user.dashboard.edit_profile.act');
    Route::post('/editpassword','User\DashboardUser@Update_password')->name('user.dashboard.editpassword');
    Route::post('/getdistrict', 'API@getDistrict')->name('user.api.getDistrict');
    Route::get('/editjadwal','User\DashboardUser@editJadwalGuru')->name('user.dashboard.edit_jadwal_guru');
    Route::post('/editjadwal','User\DashboardUser@editJadwalGuruAct')->name('user.dashboard.edit_jadwal_guru.act');

    // tambahan untuk informasi login
    Route::get('/listguru','User\DashboardUser@listguru')->name('user.dashboard.listguru');

    Route::get('/listorder','User\DashboardUser@listorder')->name('user.dashboard.listorder');
    Route::get('/listorder/pembayaran/{id}','User\DashboardUser@pembayaran')->name('user.dashboard.pembayaran');
    Route::post('/listorder/bayar','Admin\Tagihan_controller@bayar')->name('user.dashboard.bayar');
    Route::post('/listorder/konfirmasi','Admin\Tagihan_controller@konfirmasi')->name('user.dashboard.konfirmasi');

    // untuk jadwal guru
    Route::get('/jadwal','User\DashboardUser@jadwal')->name('user.dashboard.jadwal');
    Route::post('/jadwal','Admin\Jadwal_controller@store')->name('user.dashboard.jadwal.act');
    Route::get('/jadwal/edit/{id?}','User\DashboardUser@jadwaledit')->name('user.dashboard.jadwal.edit');
    Route::post('/jadwal/udpdate','Admin\Jadwal_controller@update')->name('user.dashboard.jadwal.update');
    Route::get('/jadwal/destroy/{id}','Admin\Jadwal_controller@destroy')->name('user.dashboard.jadwal.destroy');

    // untuk mapel guru
    Route::post('/mapelguru','User\MataPelajaranGuruController@store')->name('user.dashboard.mapel.act');
    Route::get('/mapelguru/edit/{id?}','User\DashboardUser@mapeledit')->name('user.dashboard.mapel.edit');
    Route::post('/mapelguru/udpdate','User\MataPelajaranGuruController@update')->name('user.dashboard.mapel.update');
    Route::get('/mapelguru/destroy/{id}','User\MataPelajaranGuruController@destroy')->name('user.dashboard.mapel.destroy');

    // untuk route Detail order terbaru
    Route::get('/order','User\DashboardUser@order')->name('user.dashboard.order');
    Route::get('/order/detail/{id}','User\DashboardUser@orderdetail')->name('user.dashboard.orderdetail');
    
    // untuk route pengaduan
    Route::get('/order/pengaduan/{id}','Admin\Pengaduan_controller@pengaduan')->name('user.dashboard.pengaduan');
    Route::post('/order/pengaduan','Admin\Pengaduan_controller@store')->name('user.dashboard.pengaduan.act');
});

Route::group(['prefix'=>'tanya'],function (){
    // untuk tanya guru
    Route::get('/','User\TanyaController@index')->name('tanya.dashboard');
    Route::get('/dashboard','User\TanyaController@index')->name('tanya.dashboard');
    Route::get('/pertanyaan','User\TanyaController@pertanyaan')->name('tanya.pertanyaan');
    Route::post('/pertanyaan','User\TanyaController@pertanyaan')->name('tanya.pertanyaan');
    Route::get('/diskusi','User\TanyaController@diskusi')->name('tanya.diskusi');
    Route::get('/edit/{id}','User\TanyaController@edit')->name('tanya.edit');
    Route::post('/store','User\TanyaController@store')->name('tanya.store');
    Route::post('/update','User\TanyaController@update')->name('tanya.update');
    Route::get('/delete/{id}','User\TanyaController@destroy')->name('tanya.delete');


    // untuk detail tanya
    Route::get('/detail/{id}','User\Detail_tanya@index')->name('tanya.detail');
    Route::post('/detail/store','User\Detail_tanya@store')->name('tanya.detail.store');
});
/**
 * Dashboard Admin
 */
Route::group(['prefix'=>'admin'], function () {
    // ini route untuk admin baru
    Route::get('/','Admin\Dashboard_controller@index')->name('admin.dashboard');
    Route::get('/dashboard','Admin\Dashboard_controller@index')->name('admin.dashboard');

    Route::get('image/{filename}', 'Admin\Order_controller@displayImage')->name('image.displayImage');

    // untuk order list
    Route::get('/listorder','Admin\Order_controller@index')->name('admin.listorder');
    Route::get('/listorder/detail/{id}','Admin\Order_controller@index')->name('admin.listorder.detail');
    Route::get('/listorder/show/{id}','Admin\Transaksi_Controller@getById_order')->name('admin.listorder.show');
    Route::post('/listorder/store','Admin\Order_controller@store')->name('admin.listorder.create');
    Route::get('/listorder/setuju/{id}','Admin\Order_controller@accepted')->name('admin.listorder.accepted');
    Route::get('/listorder/approve/{id}','Admin\Order_controller@approve')->name('admin.listorder.approve');
    Route::get('/listorder/cancel/{id}','Admin\Order_controller@cancel')->name('admin.listorder.cancel');

    // untuk detail order
    Route::post('/listorder/add','Admin\DetailOrder_controller@store')->name('admin.listorder.add');
    Route::get('/listorder/edit/{id}','Admin\DetailOrder_controller@edit')->name('admin.listorder.edit');
    Route::post('/listorder/update','Admin\DetailOrder_controller@update')->name('admin.listorder.update');
    Route::get('/listorder/delete/{id}','Admin\DetailOrder_controller@delete')->name('admin.listorder.destroy');
    Route::get('/listorder/accepted/{id}','Admin\DetailOrder_controller@accepted')->name('user.dashboard.jadwal.accepted');

    // untuk jenjang pendidikan
    Route::get('/listjenjang','Admin\Jenjang_controller@index')->name('admin.listjenjang');
    Route::post('/listjenjang/store','Admin\Jenjang_controller@store')->name('admin.listjenjang.act');
    Route::get('/listjenjang/edit/{id}','Admin\Jenjang_controller@edit')->name('admin.listjenjang.edit');
    Route::post('/listjenjang/udpdate','Admin\Jenjang_controller@update')->name('admin.listjenjang.update');
    Route::get('/listjenjang/destroy/{id}','Admin\Jenjang_controller@destroy')->name('admin.listjenjang.destroy');

    // untuk list guru
    Route::get('/listguru','Admin\Guru_controller@index')->name('admin.listguru');
    Route::post('/listguru/verifikasi','Admin\Guru_controller@verifikasi')->name('admin.listguru.verifikasi');
    Route::get('/listguru/mapel/{id}','Admin\Guru_controller@mapel')->name('admin.listguru.mapel');
    Route::post('/listguru/verifmapel','Admin\Guru_controller@verifmapel')->name('admin.listguru.verifmapel');

    // untuk list user
    Route::get('/listuser','Admin\User_controller@index')->name('admin.listuser');
    Route::get('/listuser/add','Admin\User_controller@adduser')->name('admin.listuser.add');
    Route::get('/listuser/store','Admin\User_controller@store')->name('admin.listuser.act');

    // route untuk referensi Provinsi
    Route::get('/provinsi','Admin\Provinsi_controller@index')->name('admin.listprovinsi');
    Route::post('/provinsi/store','Admin\Provinsi_controller@store')->name('admin.listprovinsi.act');
    Route::get('/provinsi/edit/{id}','Admin\Provinsi_controller@edit')->name('admin.listprovinsi.edit');
    Route::post('/provinsi/udpdate','Admin\Provinsi_controller@update')->name('admin.listprovinsi.update');
    Route::get('/provinsi/destroy/{id}','Admin\Provinsi_controller@destroy')->name('admin.listprovinsi.destroy');
    Route::get('/provinsi/list','Admin\Provinsi_controller@list')->name('admin.listprovinsi.list');

    // rout untuk refernsi Kota / Kabupaten
    Route::get('/kota','Admin\Kota_controller@index')->name('admin.listkota');
    Route::post('/kota/store','Admin\Kota_controller@store')->name('admin.listkota.act');
    Route::get('/kota/edit/{id}','Admin\Kota_controller@edit')->name('admin.listkota.edit');
    Route::post('/kota/udpdate','Admin\Kota_controller@update')->name('admin.listkota.update');
    Route::get('/kota/destroy/{id}','Admin\Kota_controller@destroy')->name('admin.listkota.destroy');

    // route untuk referensi kecamatan
    Route::get('/kecamatan','Admin\Kecamatan_controller@index')->name('admin.listkecamatan');
    Route::post('/kecamatan/store','Admin\Kecamatan_controller@store')->name('admin.listkecamatan.act');
    Route::get('/kecamatan/edit/{id}','Admin\Kecamatan_controller@edit')->name('admin.listkecamatan.edit');
    Route::post('/kecamatan/udpdate','Admin\Kecamatan_controller@update')->name('admin.listkecamatan.update');
    Route::get('/kecamatan/destroy/{id}','Admin\Kecamatan_controller@destroy')->name('admin.listkecamatan.destroy');

    //route untuk referensi mata pelajaran
    Route::get('/mapel','Admin\Mapel_controller@index')->name('admin.listmapel');
    Route::post('/mapel/store','Admin\Mapel_controller@store')->name('admin.listmapel.act');
    Route::get('/mapel/edit/{id}','Admin\Mapel_controller@edit')->name('admin.listmapel.edit');
    Route::post('/mapel/udpdate','Admin\Mapel_controller@update')->name('admin.listmapel.update');
    Route::get('/mapel/destroy/{id}','Admin\Mapel_controller@destroy')->name('admin.listmapel.destroy');

    // untuk route tagihan setelah orde belum tentu dibayar (belum masuk transaksi pembayaran)
    Route::get('/listtagihan','Admin\Tagihan_controller@index')->name('admin.listtagihan');

    // untuk route transaksi terbaru
    Route::get('/transaksi','Admin\Transaksi_Controller@index')->name('admin.listtransaksi');

    // untuk route admin pengaduan
    Route::get('/pengaduan','Admin\Pengaduan_controller@index')->name('admin.pengaduan');
    Route::get('/pengaduan/detail/{id}','Admin\Pengaduan_controller@detail')->name('admin.pengaduan.detail');
    Route::post('/pengaduan/detail/act','Admin\Pengaduan_controller@detailAct')->name('admin.pengaduan.detail.act');
    Route::get('/pengaduan/notif/{id}','Admin\Pengaduan_controller@setNotif')->name('admin.pengaduan.notif');

    // untuk route admin rekening sapaguru
    Route::get('/rekening','Admin\Rekening_controller@index')->name('admin.rekening');
    Route::post('/rekening','Admin\Rekening_controller@store')->name('admin.rekening.act');
    Route::post('/rekening/update','Admin\Rekening_controller@update')->name('admin.rekening.update');
    Route::get('/rekening/edit/{id?}','Admin\Rekening_controller@edit')->name('admin.rekening.edit');
    Route::get('/rekening/destroy/{id?}','Admin\Rekening_controller@destroy')->name('admin.rekening.destroy');
});

/**
 * Login, Register, Verification Page
 */
Route::get('/login','User\LoginController@showLoginForm')->name('login');
Route::post('/login',"User\LoginController@login")->name('login.act');
Route::get('/logout','User\LoginController@logout')->name('logout');
Route::get('/register/{id?}','User\RegisterController@showRegister')->name('register');
Route::get('/registerguru/{id?}','User\RegisterController@showRegisterGuru')->name('registerguru');
Route::post('/register','User\RegisterController@doRegister')->name('register.act');

// sementara verifikasi di alih fungsikan ikut ke dashboard
Route::get('/verification', 'User\VerificationController@showVerification')->name('verification.email');
Route::post('/verification', 'User\VerificationController@sendVerification')->name('verification.email.send');
Route::get('/verif', 'User\VerificationController@doVerification')->name('verification.email.act');



Route::get('/testing',function (){
    return "<img src='".\Illuminate\Support\Facades\Storage::url('bukti/XAUYveC2OSl51rMBVTvwvfdr6GpATOHOcMZ7KuMO.jpeg')."'>";

    $d = 2.5;
    $date = DateTime::createFromFormat('m/d/Y H','01/21/2019 08');
    $date2 = DateTime::createFromFormat('m/d/Y H','01/21/2019 08')->add(new DateInterval('PT'.floor($d).'H'))->sub(new DateInterval('PT1S'))->add(new DateInterval('PT1S'));
    //$date->add(new DateInterval('PT'.floor($d).'H'.(($d-floor($d))*60).'M'));

    return $date->format('G')."  ".$date2->format('Y-m-d H:i:s');

    $datetimeFormatted = '2019-01-01 06:00:00';
    $datetimeTillFormatted = '2019-01-01 07:59:59';

    $orderExist = DB::table(\App\OrderDate::TABLE)->join(\App\Order::TABLE,\App\Order::COL_ID,'=',\App\OrderDate::COL_ID_ORDER)
        ->where(\App\Order::COL_STATUS,'>=',\App\Order::STATUS_PAYMENT_VERIFIED)
        ->where(function ($query) use($datetimeFormatted,$datetimeTillFormatted){
            $query->whereBetween(\App\OrderDate::COL_DATETIME,[$datetimeFormatted,$datetimeTillFormatted]);
            $query->orWhereBetween(\App\OrderDate::COL_DATETIME_END,[$datetimeFormatted,$datetimeTillFormatted]);
            $query->orWhere(function ($query) use($datetimeFormatted,$datetimeTillFormatted){
                $query->where(\App\OrderDate::COL_DATETIME,'<',$datetimeFormatted);
                $query->where(\App\OrderDate::COL_DATETIME_END,'>',$datetimeTillFormatted);
            });
        });

    return $orderExist->get();

    $a = ['Gagal Membuat Pesanan'];

    $a['ok'] = 'Jadwal telah terpakai';

    return $a;
    return $orderExist->get();


    //return view('testing');
});

Route::get('/make',function (){
    $tipe_akun = new \App\TipeAkun();
    $tipe_akun->id = "10";
    $tipe_akun->nama = "Admin";

    $user = new \App\User();
    $user->email = "anantadwi13@yahoo.com";
    $user->username = "anantadwi13";
    $user->password = bcrypt("123456");
    $user->status = 1;
    $user->tipe_akun = $tipe_akun->id;
    try {
        $user->save();
    }
    catch (Exception $e){
        echo "Error";
    }

});
