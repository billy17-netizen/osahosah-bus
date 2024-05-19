<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bus_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_route_id')->constrained();
            $table->foreignId('bus_id')->constrained();
            $table->string('travel_date');
            $table->string('available_seats');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_availabilities');
    }
};
