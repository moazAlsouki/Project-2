<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'reem',
            'email'=>'reem@gmail.com',
            'mobile'=>'0952333651',
            'address'=>'Mazah',
            'city'=>'Damascus',
            'gender'=>'Female',
            'role_id'=>'1',
            'birth'=>'1990-5-2',
            'password'=>Hash::make('12345678'),
            'image'=> 'https://i.stack.imgur.com/l60Hf.png'
        ]);

    }
}
