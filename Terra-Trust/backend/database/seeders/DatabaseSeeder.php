<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'phone' => '13800138000',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'real_name' => '系统管理员',
            'address' => '系统默认',
        ]);
    }
}
