<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::where("email","superadmin@sundrive.com")->count();

        if($user < 1){

            DB::table('users')->insert([
                'name' => "Super Admin",
                'email' => 'superadmin@sundrive.com',
                'password' => Hash::make("superadmin@sundrive.com"),
                'role' => "1",
            ]);
        }    
    }
}
