<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'Toyota','Suzuki','Honda','Mercedes-Benz','BMW','Daihatsu','Nissan','Isuzu','KIA','Mitsubishi','Datsun','Mazda','Hyundai','Chevrolet'
     * @return void
     */
    public function run()
    {
        DB::table('merk')->insert([
            'name' => 'Toyota',
        ]);

        DB::table('merk')->insert([
            'name' => 'Suzuki',
        ]);

        DB::table('merk')->insert([
            'name' => 'Honda',
        ]);

        DB::table('merk')->insert([
            'name' => 'Mitsubishi',
        ]);

        DB::table('merk')->insert([
            'name' => 'BMW',
        ]);
    }
}