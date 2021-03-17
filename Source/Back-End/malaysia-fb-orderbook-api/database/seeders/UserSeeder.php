<?php

namespace Database\Seeders;

use App\Models\User;
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
        /**
         * Admin Example user
         */
        User::Insert([
            'type' => 'ADMIN',
            'status' => 'ACTIVE',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);


        /**
         * Sr Example user
         */
        User::Insert([
            'type' => 'SR',
            'status' => 'ACTIVE',
            'name' => 'Rahim Sr',
            'email' => 'rahim@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
