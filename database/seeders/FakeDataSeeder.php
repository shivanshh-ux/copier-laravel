<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Offer;
use App\Models\MediaUpload;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Plans
        $plans = Plan::factory()->count(5)->create();

        // 2. Create Customers linked to plans
        $customers = Customer::factory()->count(20)->create([
            'plan_id' => fn() => $plans->random()->id
        ]);

        // 3. Create Orders linked to customers and plans
        foreach ($customers as $customer) {
            Order::factory()->count(rand(1, 3))->create([
                'customer_id' => $customer->id,
                'plan_id' => $customer->plan_id,
                'amount' => $customer->plan->actual_price // Use real plan price
            ]);
        }

        // 4. Create Offers
        Offer::factory()->count(8)->create([
            'plan_id' => fn() => $this->faker()->boolean(50) ? $plans->random()->id : null
        ]);

        // 5. Create Media Uploads
        MediaUpload::factory()->count(12)->create();
    }

    protected function faker()
    {
        return \Faker\Factory::create();
    }
}
