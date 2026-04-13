<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fars = Province::query()->create([
            "name" => "فارس"
        ]);

        $tehran = Province::query()->create([
            "name" => "تهران"
        ]);

        $esfahan = Province::query()->create([
            "name" => "اصفهان"
        ]);

        City::query()->create([
            "name" => "شیراز",
            "province_id" => $fars->id
        ]);

        City::query()->create([
            "name" => "تهران",
            "province_id" => $tehran->id
        ]);

        City::query()->create([
            "name" => "اصفهان",
            "province_id" => $esfahan->id
        ]);
    }
}
