<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "email" => "anantadwi13@yahoo.com",
                "username" => "anantadwi13",
                "password" => bcrypt("123123"),
                "tipe_akun" => \App\User::TIPE_GURU
            ]
        ];
        try{
            \Illuminate\Support\Facades\DB::beginTransaction();

            foreach ($users as $user) {
                $u = \App\User::create($user);
                \App\UserData::create(["id"=>$u->id]);
                if ($u->tipe_akun == \App\User::TIPE_GURU)
                    \App\DataGuru::create(["id"=>$u->id]);
                \App\UserStatus::create(["id"=>$u->id]);
            }

            \Illuminate\Support\Facades\DB::commit();
        }catch (Exception $exception){
            echo "ERROR\n".$exception;
        }
    }
}
