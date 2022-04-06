<?php

namespace Database\Seeders;

use App\Models\DuesCategory;
use Illuminate\Database\Seeder;

class DuesCategorySeeder extends Seeder
{
    private array $datas = [
        [
            'id' => 1,
            'code' => 'IRSMPH',
            'name' => 'Iuran Sampah',
            'amount' => 25000,
            'description' => "Deskripsi Iuran Sampah"
        ],
        [
            'id' => 2,
            'code' => 'IRKMN',
            'name' => 'Iuran Keamanan',
            'amount' => 25000,
            'description' => "Deskripsi Iuran Keamanan"
        ],
        [
            'id' => 3,
            'code' => 'IRMKN',
            'name' => 'Iuran Makan',
            'amount' => 25000,
            'description' => "Deskripsi Iuran Makan"
        ],
        [
            'id' => 4,
            'code' => 'IRAG',
            'name' => 'Iuran Keagamaan',
            'amount' => 10000,
            'description' => "Deskripsi Iuran Keagamaan"
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->datas as $value) {
            DuesCategory::create($value);
        }
    }
}
