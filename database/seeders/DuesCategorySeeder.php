<?php

namespace Database\Seeders;

use App\Models\DuesCategory;
use Illuminate\Database\Seeder;

class DuesCategorySeeder extends Seeder
{
    private array $datas = [
        [
            'id' => 1,
            'code' => 'iuran_sampah',
            'name' => 'Iuran Sampah',
            'description' => "Deskripsi Iuran Sampah"
        ],
        [
            'id' => 2,
            'code' => 'iuran_keamanan',
            'name' => 'Iuran Keamanan',
            'description' => "Deskripsi Iuran Keamanan"
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
