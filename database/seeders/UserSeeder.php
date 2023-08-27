<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('0000'),
            'is_admin' => true
        ]);
        
        User::factory()->count(10)->create();

    }
}
