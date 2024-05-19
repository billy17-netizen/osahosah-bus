<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->foreignId('bus_route_id')->constrained();
            $table->foreignId('bus_id')->constrained();
            $table->string('seat_number');
            $table->string('total_seats');
            $table->foreignId('pickup_service_id')->constrained();
            $table->string('ticket_number')->unique()->nullable();
            $table->string('ticket_status')->nullable();
            $table->string('travel_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
