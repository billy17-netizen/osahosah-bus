<?php

namespace Database\Seeders;

use App\Models\BusAvailability;
use Illuminate\Database\Seeder;

class BusAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        BusAvailability::insert([
            array(
                "id" => 1,
                "bus_route_id" => 1,
                "bus_id" => 2,
                "travel_date" => "2024-05-07 00:00",
                "available_seats" => "50",
                "created_at" => "2024-05-05 05:42:12",
                "updated_at" => "2024-05-06 01:17:21",
            ),
            array(
                "id" => 5,
                "bus_route_id" => 1,
                "bus_id" => 4,
                "travel_date" => "2024-05-07 00:00",
                "available_seats" => "45",
                "created_at" => "2024-05-05 06:08:09",
                "updated_at" => "2024-05-05 06:08:09",
            ),
            array(
                "id" => 6,
                "bus_route_id" => 1,
                "bus_id" => 5,
                "travel_date" => "2024-05-07 00:00",
                "available_seats" => "55",
                "created_at" => "2024-05-05 06:08:33",
                "updated_at" => "2024-05-05 06:13:57",
            ),
            array(
                "id" => 7,
                "bus_route_id" => 1,
                "bus_id" => 3,
                "travel_date" => "2024-05-07 00:00",
                "available_seats" => "50",
                "created_at" => "2024-05-05 06:09:08",
                "updated_at" => "2024-05-05 06:43:10",
            ),
            array(
                "id" => 8,
                "bus_route_id" => 1,
                "bus_id" => 6,
                "travel_date" => "2024-05-07 00:00",
                "available_seats" => "60",
                "created_at" => "2024-05-05 06:16:27",
                "updated_at" => "2024-05-05 06:42:58",
            ),

        ]);
    }
}
