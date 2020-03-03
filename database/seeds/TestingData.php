<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\KotaKab;
use Faker\Factory as Faker;


class TestingData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kota_kode = KotaKab::all()->pluck('kode_kota')->toArray();
 
    	for($i = 1; $i <= 50; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('users')->insert([
                'id' => $i,
                'email' => $faker->email,
                'username' => $faker->userName,
                'password' => bcrypt('testing'),
                'tipe_akun' => $faker->numberBetween(1,2),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            DB::table('user_data')->insert([
                'id' => $i,
                'no_identitas' => Str::random(10),
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
                'nama_panggilan' => $faker->firstName,
                'no_hp' => Str::random(15),
                'deskripsi' => $faker->sentence,
                'tempat_lahir' => $faker->randomElement($kota_kode),
                'tanggal_lahir' => $faker->date,
                'alamat_jalan' => $faker->address,
                'alamat_kota' => $faker->randomElement($kota_kode),
                'alamat_jalan_domisili' => $faker->address,
                'alamat_kota_domisili' => $faker->randomElement($kota_kode),
                'asal_sekolah' => Str::random(10),
                'status_sekolah' => $faker->numberBetween(1,2),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('user_status')->insert([
                'id' => $i,
                'not_activated' => $faker->numberBetween(1,2),
                'suspended' => $faker->numberBetween(1,2),
                'email_activated' => $faker->numberBetween(1,2),
                'verified_profile' => $faker->numberBetween(1,2),
                'accepted_teacher' => $faker->numberBetween(1,2),
                'created_at' => now(),
                'updated_at' => now()
            ]);
 
    	}
    }
}
