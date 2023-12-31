<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = 'momchil@sportfanstickers.com';
        $user = User::where('email', '=', $adminEmail)->first();
        if ($user === null) {
            // user doesn't exist
            DB::table('users')->insert([
                'name' => 'Admin',
                'user_type' => 'admin',
                'email' => $adminEmail,
                'password' => Hash::make('password#2023'),
            ]);
        }
    }
}
