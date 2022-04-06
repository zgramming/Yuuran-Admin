<?php

namespace Database\Seeders;

use App\Models\UserGroup;
use Illuminate\Database\Seeder;

class AppGroupUserSeeder extends Seeder
{
    private array $datas = [
        [
            'id' => 1,
            'code' => 'superadmin',
            'name' => 'Super Admin',
            'status' => 'active',
        ],
        [
            'id' => 2,
            'code' => 'bendahara',
            'name' => 'Bendahara',
            'status' => 'active',
        ],
        [
            'id' => 3,
            'code' => 'warga',
            'name' => 'Warga',
            'status' => 'active',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->datas as $key => $value) {
            UserGroup::create($value);
        }
    }
}
