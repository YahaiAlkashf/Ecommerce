<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
                'name'=>'yahya alkashf',
                'email'=>'yeheimohmed@gmail.com',
                'password'=>'yehei2023',
                'role'=>'admin'
        ]);
    }
}
