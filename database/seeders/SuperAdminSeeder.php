<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'superadmin1@gmail.com',
            'password' => '123123123',
            'secret_key' => '123',
            'added_by' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

