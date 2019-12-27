<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Request $request)
    {
        User::create([
            'id' => 1,
            'staff_code' => '101005151',
            'name' => '方高平',
            'email' => 'fanggaoping@huaqin.com',
            'phone' => '18676674421',
            'gender' => 'male',
            'work_place' => '东莞',
            'avatar' => null,
            'password' => bcrypt('auto1234'),
            'last_ip' => $request->ip(),
            'is_admin' => 1,
            'user_type' => 'huaqin',
            'email_verified_at' => now()
        ]);
    }
}
