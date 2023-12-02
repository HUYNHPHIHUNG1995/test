<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_catalogue_id' => rand(1, 2),
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => Hash::make('123456'),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('users')->insert([
            'user_catalogue_id' => rand(1, 2),
            'email' => 'admin1@gmail.com',
            'name' => 'admin1',
            'password' => Hash::make('1234567'),
            'created_at'=> Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        User::factory()->count(50)->create();
        
    }
}
