<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name' => 'Electra Power',
            'role' => 'admin',
            'email' => 'electrapower@gmail.com',
            'password' => \Hash::make('electrapower123'),
            'ttd' => 'ttd/ttd_electra_power.png',
        ]);
    }
}
