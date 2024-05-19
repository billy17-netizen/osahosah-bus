<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        Bus::insert([
            array(
                "id" => 2,
                "bus_number" => "BN000000001",
                "capacity" => 50,
                "bus_name" => " Anas Nasional Sejahtera",
                "image_url" => "1714699273.png",
                "price_per_seat" => "100000.00",
                "status" => 1,
                "created_at" => "2024-05-02 05:52:59",
                "updated_at" => "2024-05-03 01:21:13",
            ),
            array(
                "id" => 3,
                "bus_number" => "BN000000002",
                "capacity" => 50,
                "bus_name" => "Subur Jaya",
                "image_url" => "1714821469.jpg",
                "price_per_seat" => "100000.00",
                "status" => 1,
                "created_at" => "2024-05-02 12:07:11",
                "updated_at" => "2024-05-02 12:07:11",
            ),
            array(
                "id" => 4,
                "bus_number" => "BN000000003",
                "capacity" => 45,
                "bus_name" => "Kalingga Jaya",
                "image_url" => "1714821541.jpg",
                "price_per_seat" => "100000.00",
                "status" => 1,
                "created_at" => "2024-05-02 12:09:02",
                "updated_at" => "2024-05-02 12:09:02",
            ),
            array(
                "id" => 5,
                "bus_number" => "BN000000004",
                "capacity" => 55,
                "bus_name" => "Sinar Jaya",
                "image_url" => "1714821605.jpg",
                "price_per_seat" => "100000.00",
                "status" => 1,
                "created_at" => "2024-05-02 12:13:51",
                "updated_at" => "2024-05-02 12:13:51",
            ),
            array(
                "id" => 6,
                "bus_number" => "BN000000005",
                "capacity" => 60,
                "bus_name" => "Zentrum",
                "image_url" => "1714821665.jpg",
                "price_per_seat" => "100000.00",
                "status" => 1,
                "created_at" => "2024-05-02 12:16:09",
                "updated_at" => "2024-05-02 12:16:09",
            ),
        ]);
    }
}
