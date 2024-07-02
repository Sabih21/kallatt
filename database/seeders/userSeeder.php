<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name'      =>  'Admin',
                'email'     =>  'admin@email.com',
                'password'  =>  'admin',
                'status'    =>  'approved',
                'phone'     =>  '123456',
                'user_type' =>  1,    
            ]
        );

        User::create(
            [
                'name'      =>  'Customer',
                'email'     =>  'customer@email.com',
                'password'  =>  'customer',
                'status'    =>  'approved',
                'phone'     =>  '123457',
                'user_type' =>  0,    
            ]
        );
    }
}
