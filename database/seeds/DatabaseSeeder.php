<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvinsiSeeder::class);
        $this->call(KotaKabSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(TipeAkunSeeder::class);
        $this->call(JenjangPendidikanSeeder::class);
        $this->call(UserSeeder::class);
    }
}
