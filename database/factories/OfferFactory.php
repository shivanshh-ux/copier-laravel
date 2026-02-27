<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition(): array
    {
        $actualPrice = $this->faker->randomFloat(2, 500, 5000);
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'plan_id' => $this->faker->boolean(50) ? Plan::factory() : null,
            'actual_price' => $actualPrice,
            'discounted_price' => $actualPrice * 0.7,
            'valid_until' => $this->faker->dateTimeBetween('now', '+2 months'),
            'is_active' => true,
        ];
    }
}
