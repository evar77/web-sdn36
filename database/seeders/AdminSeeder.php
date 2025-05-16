<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin SDN36',
            'email' => 'admin@sdn36.com',
            'password' => Hash::make('password133')
        ]);
    }
}

