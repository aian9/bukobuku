<?php

use Illuminate\Database\Seeder;

class TipeAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            \Illuminate\Support\Facades\DB::beginTransaction();
            $murid = new \App\TipeAkun();
            $murid->id = 1;
            $murid->nama = "Murid";
            $murid->save();
            $guru = new \App\TipeAkun();
            $guru->id = 2;
            $guru->nama = "Guru";
            $guru->save();
            $admin = new \App\TipeAkun();
            $admin->id = 10;
            $admin->nama = "Admin";
            $admin->save();
            DB::commit();
        }catch (\Exception $exception){
            echo "Error Creating Account Type";
        }
    }
}
