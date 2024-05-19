<?php

namespace Database\Seeders;

use App\Models\BusDetail;
use Illuminate\Database\Seeder;

class BusDetailSeeder extends Seeder
{
    public function run(): void
    {
        BusDetail::insert([
            array(
                "id" => 1,
                "bus_id" => 2,
                "model" => "XYZ-1580",
                "color" => "Biru-Putih",
                "manufacturing_year" => 2010,
                "wifi" => 1,
                "ac" => 1,
                "dinner" => 0,
                "about_the_bus" => "Untuk mempercepat perjalanan Anda, kami menambahkan fasilitas Kapal Eksekutif & Via timur yang dapat mempercepat waktu perjalanan hingga 6 jam. Kami selalu berusaha meningkatkan layanan untuk memenuhi kebutuhan konsumen agar dapat terus berjalan sesuai dengan moto kami yang aman hingga titik nyaman.",
                "essentials" => "Pillow, Water",
                "snacks" => "Juice / shake",
                "safety_features" => "Sanitized, Masks",
                "created_at" => "2024-05-02 05:52:59",
                "updated_at" => "2024-05-03 03:13:13",
            ),
            array(
                "id" => 2,
                "bus_id" => 3,
                "model" => "XYZ-2000",
                "color" => "Biru",
                "manufacturing_year" => 2022,
                "wifi" => 1,
                "ac" => 1,
                "dinner" => 0,
                "about_the_bus" => "Mega Express adalah bus mewah dengan interior yang nyaman dan fasilitas lengkap. Didesain untuk memberikan pengalaman perjalanan yang menyenangkan bagi penumpang.",
                "essentials" => "P3K, Alat Keselamatan",
                "snacks" => "Minuman Gratis, Snack Ringan",
                "safety_features" => "Sistem Rem ABS, Sistem Keamanan Pengemudi",
                "created_at" => "2024-05-02 12:07:11",
                "updated_at" => "2024-05-02 12:07:11",
            ),
            array(
                "id" => 3,
                "bus_id" => 4,
                "model" => "ABC-3000",
                "color" => "Putih",
                "manufacturing_year" => 2021,
                "wifi" => 1,
                "ac" => 1,
                "dinner" => 1,
                "about_the_bus" => "Speedy Shuttle adalah pilihan tepat untuk perjalanan jarak menengah dengan kenyamanan tinggi. Dilengkapi dengan fasilitas makanan dan minuman untuk kenyamanan penumpang.",
                "essentials" => "P3K, Pemadam Kebakaran",
                "snacks" => "Makanan Ringan, Minuman Panas",
                "safety_features" => "Sistem Monitor Tekanan Ban, Sistem Pengingat Pemakaian Sabuk Keselamatan",
                "created_at" => "2024-05-02 12:09:02",
                "updated_at" => "2024-05-02 12:09:02",
            ),
            array(
                "id" => 4,
                "bus_id" => 5,
                "model" => "DEF-4000",
                "color" => "Merah",
                "manufacturing_year" => 2023,
                "wifi" => 1,
                "ac" => 1,
                "dinner" => 1,
                "about_the_bus" => "City Cruiser adalah pilihan ideal untuk perjalanan dalam kota maupun antar kota. Dilengkapi dengan fasilitas makanan dan minuman untuk kenyamanan penumpang.",
                "essentials" => "P3K, Alat Pemadam Kebakaran",
                "snacks" => "Makanan Ringan, Minuman Dingin",
                "safety_features" => "Sistem Pengereman Darurat, Sistem Peringatan Tabrakan",
                "created_at" => "2024-05-02 12:13:51",
                "updated_at" => "2024-05-02 12:13:51",
            ),
            array(
                "id" => 5,
                "bus_id" => 6,
                "model" => "GHI-5000",
                "color" => "Hijau",
                "manufacturing_year" => 2024,
                "wifi" => 1,
                "ac" => 1,
                "dinner" => 0,
                "about_the_bus" => "Travel Master adalah pilihan terbaik untuk perjalanan panjang dengan kenyamanan dan keamanan terjamin. Didesain untuk memenuhi kebutuhan perjalanan yang beragam.",
                "essentials" => "P3K, Alat Penyelamat",
                "snacks" => "Minuman Gratis, Camilan Sehat",
                "safety_features" => "Sistem Penghindaran Tabrakan, Sistem Pengereman Anti-Blokir",
                "created_at" => "2024-05-02 12:16:09",
                "updated_at" => "2024-05-02 12:16:09",
            ),
        ]);
    }
}
