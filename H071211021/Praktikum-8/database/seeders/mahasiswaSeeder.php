<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class mahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 1000; $i++){
 
    		DB::table('mahasiswas')->insert([
            'nama' => $faker->name,
            'nim' => $faker->bothify('?#########'),
            'alamat' => $faker->address,
            'fakultas' => $faker->randomElement(['Ekonomi & Bisnis', 'Hukum','Kedokteran', 'Teknik','Ilmu Sosial dan Ilmu Politik','Ilmu Budaya','Matematika dan Ilmu Pengetahuan Alam','Peternakan', 'Kedokteran Gigi', 'Kesehatan Masyarakat', 'Ilmu Kelautan & Perikanan,Kehutanan','Farmasi','Keperawatan'])
    		]);
        }
    }
}
