<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'phone'=>'012345678902'
        ]);

        DB::table('users')->insert([
            'name'=>'hadeer zayed',
            'email'=>'hader@gmail.com',
            'password'=>Hash::make('password'),
            'phone'=>'01020359392'
        ]);
    }
}
