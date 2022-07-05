<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('admin@3127');
        DB::table('users')->insert([
            'name'=>'admin Raiyani',
            'email'=>'admin@gmail.com',
            'DOB'=>'2001-09-03',
            'Profile'=>'625687cde6e05avatar-male.png',
            'UserType'=>2,
            'IsApproved'=>1,
            'password'=> $password,
            'Lockout_End'=>now()
        ]);
    }
}
