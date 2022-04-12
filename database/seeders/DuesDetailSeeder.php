<?php

namespace Database\Seeders;

use App\Models\Dues\DuesDetail;
use Illuminate\Database\Seeder;
use Str;

class DuesDetailSeeder extends Seeder
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
                "id" => Str::uuid(),
                "dues_category_id" => 1,
                "users_id" => 3,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 25000,
                "status" => "paid_off",
                "paid_by_someone_else" => false,
                "created_by" => 3,
            ],
            [
                "id" => Str::uuid(),
                "dues_category_id" => 2,
                "users_id" => 3,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 15000,
                "status" => "not_paid_off",
                "paid_by_someone_else" => false,
                "created_by" => 3,
            ],
            [
                "id" => Str::uuid(),
                "dues_category_id" => 3,
                "users_id" => 3,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 25000,
                "status" => "paid_off",
                "paid_by_someone_else" => true,
                "description" => "Dibayarkan oleh anaknya, karena yang bersangkutan belum pulang kerja.",
                "created_by" => 3,
            ],


            [
                "id" => Str::uuid(),
                "dues_category_id" => 1,
                "users_id" => 4,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 25000,
                "status" => "paid_off",
                "paid_by_someone_else" => false,
                "created_by" => 4,
            ],
            [
                "id" => Str::uuid(),
                "dues_category_id" => 2,
                "users_id" => 4,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 15000,
                "status" => "not_paid_off",
                "paid_by_someone_else" => false,
                "created_by" => 4,
            ],
            [
                "id" => Str::uuid(),
                "dues_category_id" => 3,
                "users_id" => 4,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 25000,
                "status" => "paid_off",
                "paid_by_someone_else" => true,
                "description" => "Dibayarkan oleh anaknya, karena yang bersangkutan belum pulang kerja.",
                "created_by" => 4,
            ],


            [
                "id" => Str::uuid(),
                "dues_category_id" => 1,
                "users_id" => 5,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 25000,
                "status" => "paid_off",
                "paid_by_someone_else" => false,
                "created_by" => 5,
            ],
            [
                "id" => Str::uuid(),
                "dues_category_id" => 2,
                "users_id" => 5,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 15000,
                "status" => "not_paid_off",
                "paid_by_someone_else" => false,
                "created_by" => 5,
            ],
            [
                "id" => Str::uuid(),
                "dues_category_id" => 3,
                "users_id" => 5,
                "month"=> date('m'),
                "year"=> date("Y"),
                "amount" => 25000,
                "status" => "paid_off",
                "paid_by_someone_else" => true,
                "description" => "Dibayarkan oleh anaknya, karena yang bersangkutan belum pulang kerja.",
                "created_by" => 5,
            ],

        ];

        foreach ($datas as $value) {
            DuesDetail::create($value);
        }
    }
}
