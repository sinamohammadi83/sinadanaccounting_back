<?php

namespace Database\Factories;

use App\Models\Factor;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactorProductFactory extends Factory
{
    public function definition(): array
    {
        $count = fake()->numberBetween(1, 20);

        $unitPrice = fake()->numberBetween(
            50000,
            5000000
        );

        $discount = fake()->numberBetween(
            0,
            intval($unitPrice * 0.2)
        );

        $tax = intval(
            ($unitPrice * $count - $discount)
            * 0.09
        );

        return [

            'factor_id' => Factor::query()
                ->inRandomOrder()
                ->value('id'),

            'product_id' => Product::query()
                ->inRandomOrder()
                ->value('id'),

            'storage_id' => Storage::query()
                ->inRandomOrder()
                ->value('id'),

            'description' => fake()->optional()
                ->sentence(),

            'unit' => fake()->randomElement([
                'عدد',
                'کیلو',
                'بسته',
                'متر',
                'کارتن'
            ]),

            'count' => $count,

            'unit_price' => $unitPrice,

            'discount' => $discount,

            'tax' => $tax,

            'total_price' =>

                ($unitPrice * $count)

                - $discount

                + $tax

        ];
    }
}