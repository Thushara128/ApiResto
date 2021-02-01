<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
           [ 'dishname'=>'Veg Biryani',
            'available'=>'5',
            'price'=>'70'],

            [ 'dishname'=>'chicken Biryani',
            'available'=>'15',
            'price'=>'100'],

            [ 'dishname'=>'meal',
            'available'=>'5',
            'price'=>'70'],

            [ 'dishname'=>'special meal',
            'available'=>'15',
            'price'=>'100'],

            [ 'dishname'=>'tea',
            'available'=>'100',
            'price'=>'10'],

        ]);
          
    }
}
