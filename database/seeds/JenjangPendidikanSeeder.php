<?php

use Illuminate\Database\Seeder;

class JenjangPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenjang = [
            [
                "id" => '1',
                "nama" => "SD",
                "tingkat" => "Kelas 1",
            ],
            [
                "id" => '2',
                "nama" => "SD",
                "tingkat" => "Kelas 2",
            ],
            [
                "id" => '3',
                "nama" => "SD",
                "tingkat" => "Kelas 3",
            ],
            [
                "id" => '4',
                "nama" => "SD",
                "tingkat" => "Kelas 4",
            ],
            [
                "id" => '5',
                "nama" => "SD",
                "tingkat" => "Kelas 5",
            ],
            [
                "id" => '6',
                "nama" => "SD",
                "tingkat" => "Kelas 6",
            ],
            [
                "id" => '7',
                "nama" => "SMP",
                "tingkat" => "Kelas 7",
            ],
            [
                "id" => '8',
                "nama" => "SMP",
                "tingkat" => "Kelas 8",
            ],
            [
                "id" => '9',
                "nama" => "SMP",
                "tingkat" => "Kelas 9",
            ],
            [
                "id" => '10',
                "nama" => "SMA",
                "tingkat" => "Kelas 10",
            ],
            [
                "id" => '11',
                "nama" => "SMA",
                "tingkat" => "Kelas 11",
            ],
            [
                "id" => '12',
                "nama" => "SMA",
                "tingkat" => "Kelas 12",
            ],
            [
                "id" => '13',
                "nama" => "D1",
            ],
            [
                "id" => '14',
                "nama" => "D3",
            ],
            [
                "id" => '15',
                "nama" => "D4",
            ],
            [
                "id" => '16',
                "nama" => "S1",
            ],
            [
                "id" => '17',
                "nama" => "S2",
            ],
            [
                "id" => '18',
                "nama" => "S3",
            ],
        ];
        try{
            \Illuminate\Support\Facades\DB::beginTransaction();
            foreach ($jenjang as $jen){
                \App\JenjangPendidikan::create($jen);
            }
            DB::commit();
        }catch (\Exception $exception){
            echo "Error Creating Jenjang Pendidikan\n".$exception->getMessage()."\n";
        }
    }
}
