<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscription_plans')->insert([
            [
                'name' => 'Monthly',
                'monthly_cost' => 20,
            ],
            [
                'name' => 'Yearly',
                'monthly_cost' => 15,
            ]
        ]);
    }
}
