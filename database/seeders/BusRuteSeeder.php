<?php

namespace Database\Seeders;

use App\Models\BusRoute;
use Illuminate\Database\Seeder;

class BusRuteSeeder extends Seeder
{
    public function run(): void
    {
        BusRoute::insert([
            array(
                "id" => 1,
                "origin" => "Jakarta",
                "destination" => "Surabaya",
                "distance" => 775.00,
                "duration" => 20,
                "pickup_service_id" => 1,
                "start_date" => "04/04/2024",
                "end_date" => "04/04/2025",
                "created_at" => "2024-05-04 02:38:42",
                "updated_at" => "2024-05-04 02:51:42",
            ),
            array(
                "id" => 2,
                "origin" => "Jakarta Timur",
                "destination" => "Jakarta Barat",
                "distance" => 35.20,
                "duration" => 1,
                "pickup_service_id" => 2,
                "start_date" => "04/04/2024",
                "end_date" => "04/04/2025",
                "created_at" => "2024-05-04 02:43:38",
                "updated_at" => "2024-05-04 02:43:38",
            ),
        ]);
    }
}
