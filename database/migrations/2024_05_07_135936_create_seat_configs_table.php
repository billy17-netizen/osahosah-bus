<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seat_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained();
            $table->string('code'); // A1, A2, A3, B1, B2, B3, etc.
            $table->enum('status', ['available', 'sold_out'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seat_configs');
    }
};
