<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
           'name'=>'Quần Áo Nam',
            'parent_id'=>0,
            'description'=>'Quần áo nam',
            'content'=>'Quần áo nam',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Quần Áo Nữ',
            'parent_id'=>0,
            'description'=>'Quần áo nữ',
            'content'=>'Quần áo nữ',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Nước hoa',
            'parent_id'=>0,
            'description'=>'Nước hoa',
            'content'=>'Nước hoa',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Giày',
            'parent_id'=>0,
            'description'=>'giày dép',
            'content'=>'giày dép',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'name'=>'Quần nam',
            'parent_id'=>1,
            'description'=>'Quần nam',
            'content'=>'Quần nam',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Áo nam',
            'parent_id'=>1,
            'description'=>'Áo nam',
            'content'=>'Áo nam',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Quần nữ',
            'parent_id'=>2,
            'description'=>'Quần nữ',
            'content'=>'Quần nữ',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Áo nữ',
            'parent_id'=>2,
            'description'=>'Áo nữ',
            'content'=>'Áo nữ',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Nước hoa nam',
            'parent_id'=>3,
            'description'=>'Nước hoa nam',
            'content'=>'Nước hoa nam',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('menus')->insert([
            'name'=>'Nước hoa nữ',
            'parent_id'=>3,
            'description'=>'Nước hoa nữ',
            'content'=>'Nước hoa nữ',
            'active'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}
