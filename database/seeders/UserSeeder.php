<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
    
        //Create an admin
        User::create([
            'name' => 'admin',
            'email'=>'admin@mycompany.com',
            'password'=> Hash::make('password'),
            'type' => 'admin',
            'is_admin' => 1,
            'active_status' => 1
        ]);
    }
}