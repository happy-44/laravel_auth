<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12341234'),
            'phone' => '123456543',
            'address' => 'no. 22, WZ-174, Street No. 2,',
            'photo' => '',
            'role' => 'superadmin',
        ]);
    }
}
