<?php

namespace Database\Seeders;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            'name' => 'Việt Nam',
            'canonical'=>'VN',
            'image'=>'userfiles/image/Languages/viet.png',
            'user_id'=>'1',
            'publish'=>'1',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}
