<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Tambahkan ini untuk class User
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk class Has

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator BAPPERIDA',
            'email' => 'admin@bapperida.go.id',
            'password' => Hash::make('admin_123'),
            'role' => 'admin',
        ]);
    }
}
