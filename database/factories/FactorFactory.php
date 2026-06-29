<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Person;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factor>
 */
class FactorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $total = fake()->numberBetween(500000, 50000000);

        $paid = fake()->numberBetween(
            intval($total * 0.3),
            $total
        );

        $date = fake()->dateTimeBetween(
            '-2 years',
            'now'
        );
         return [

            'branch_id' => Branch::query()
                ->inRandomOrder()
                ->value('id'),

            'staff_id' => Staff::query()
                ->inRandomOrder()
                ->value('id'),

            'category_id' => Category::query()
                ->inRandomOrder()
                ->value('id'),

            'person_id' => Person::query()
                ->inRandomOrder()
                ->value('id'),

            'title' => 'FAC-' . Str::random(12),

            'date' => $date,

            'due_date' => fake()->dateTimeBetween(
                $date,
                '+3 months'
            ),

            'paid_price' => $paid,

            'total_price' => $total,

            'type' => fake()->boolean(),

        ];
    }
}
