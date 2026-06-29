<?php

namespace Database\Seeders;

use App\Models\Factor;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Factor::factory()
    ->count(1000)
    ->create()
    ->each(function ($factor) {

        $products = Product::query()
            ->inRandomOrder()
            ->limit(rand(1, 5))
            ->get();

        foreach ($products as $product) {

            $count = rand(1, 20);
            $price = rand(100000, 5000000);
            $discount = rand(0, $price * 0.2);
            $tax = ($price * $count - $discount) * 0.09;

            $factor->factorProduct()->attach(
                $product->id,
                [
                    'storage_id' => Storage::query()
                        ->inRandomOrder()
                        ->value('id'),

                    'description' => fake()->sentence(),

                    'unit' => 'عدد',

                    'count' => $count,

                    'unit_price' => $price,

                    'discount' => $discount,

                    'tax' => $tax,

                    'total_price' =>
                        ($price * $count)
                        - $discount
                        + $tax
                ]
            );

        }

    });

    }
}
