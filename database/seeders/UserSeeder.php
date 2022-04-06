<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $datas = [
            [
                "id" => 1,
                'username' => 'superadmin',
                'name' => "Super Admin",
                'email' => "superadmin@gmail.com",
                'email_verified_at' => now(),
                'password' => "superadmin", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 1,
                'status' => 'active',
            ],
            [
                "id" => 2,
                'username' => 'bendahara',
                'name' => "Bendahara",
                'email' => "bendahara@gmail.com",
                'email_verified_at' => now(),
                'password' => "bendahara", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 2,
                'status' => 'active',
            ],
            [
                "id" => 3,
                'username' => 'zeffry',
                'name' => "Zeffry Reynando",
                'email' => "zeffryreynando@gmail.com",
                'email_verified_at' => now(),
                'password' => "zeffry", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 3,
                'status' => 'active',
            ],
            [
                "id" => 4,
                'username' => 'syarif',
                'name' => "Syarif Hidayatullah",
                'email' => "syarif@gmail.com",
                'email_verified_at' => now(),
                'password' => "syarif", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 3,
                'status' => 'active',
            ],
            [
                "id" => 5,
                'username' => 'helmi',
                'name' => "Helmi Aji",
                'email' => "helmi@gmail.com",
                'email_verified_at' => now(),
                'password' => "helmi", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 3,
                'status' => 'active',
            ],
            [
                "id" => 6,
                'username' => 'anggit',
                'name' => "Anggit PP",
                'email' => "anggit@gmail.com",
                'email_verified_at' => now(),
                'password' => "anggit", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 3,
                'status' => 'active',
            ],
            [
                "id" => 7,
                'username' => 'umar',
                'name' => "Umar Bawazir",
                'email' => "umar@gmail.com",
                'email_verified_at' => now(),
                'password' => "umar", // password
                'remember_token' => Str::random(10),
                'app_group_user_id' => 3,
                'status' => 'active',
            ],
        ];

        foreach ($datas as $value) {
            User::create($value);
        }
    }
}

