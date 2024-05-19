<?php

namespace Database\Seeders;

use App\Models\PickupService;
use Illuminate\Database\Seeder;

class PickupServicesSeeder extends Seeder
{
    public function run(): void
    {
        PickupService::insert([
            [
                "id" => 1,
                "pickup_location" => "Terminal Pulo Gebang",
                "dropping_point" => "Terminal Bungurasih",
                "latlong" => "-6.21307528699102, 106.94618486542028", // Add this line
                "pickup_fee" => 20000.00,
                "pickup_time" => "09:00",
                "dropping_time" => "00:00",
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 2,
                "pickup_location" => "Terminal Kampung Rambutan",
                "dropping_point" => "Terminal Kalideres",
                "latlong" => "-6.3091567166109135, 106.8823978089594", // Add this line
                "pickup_fee" => 10000.00,
                "pickup_time" => "09:00",
                "dropping_time" => "00:00",
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
