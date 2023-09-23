<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name'=>'Quần tây Hàn quốc',
            'description'=>'Quần tây Hàn quốc',
            'content'=>'Quần tây Hàn quốcQuần tây Hàn quốcQuần tây Hàn quốc',
            'thumb'=>'123.img',
            'menu_id'=>5,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Quần tây Hàn quốc',
            'description'=>'Quần tây Hàn quốc',
            'content'=>'Quần tây Hàn quốcQuần tây Hàn quốcQuần tây Hàn quốc',
            'thumb'=>'123.img',
            'menu_id'=>5,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Áo sơmi nam',
            'description'=>'Áo sơmi nam',
            'content'=>'Áo sơmi namÁo sơmi namÁo sơmi namÁo sơmi nam',
            'thumb'=>'123.img',
            'menu_id'=>6,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Áo sơmi nam',
            'description'=>'Áo sơmi nam',
            'content'=>'Áo sơmi namÁo sơmi namÁo sơmi namÁo sơmi nam',
            'thumb'=>'123.img',
            'menu_id'=>6,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Quần tây nữ',
            'description'=>'Quần tây nữ',
            'content'=>'Quần tây nữQuần tây nữQuần tây nữ',
            'thumb'=>'123.img',
            'menu_id'=>7,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Quần tây nữ',
            'description'=>'Quần tây nữ',
            'content'=>'Quần tây nữQuần tây nữQuần tây nữ',
            'thumb'=>'123.img',
            'menu_id'=>7,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Áo sơmi nữ',
            'description'=>'Áo sơmi nữ',
            'content'=>'Áo sơmi nữ',
            'thumb'=>'123.img',
            'menu_id'=>8,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name'=>'Áo sơmi nữ',
            'description'=>'Áo sơmi nữ',
            'content'=>'Áo sơmi nữ',
            'thumb'=>'123.img',
            'menu_id'=>8,
            'price'=>200000,
            'price_sale'=>160000,
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}
