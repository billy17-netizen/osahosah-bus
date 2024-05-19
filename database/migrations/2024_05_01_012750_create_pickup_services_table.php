<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pickup_services', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_location');
            $table->string('dropping_point');
            $table->string('latlong');
            $table->decimal('pickup_fee');
            $table->string('pickup_time');
            $table->string('dropping_time');
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pickup_services');
    }
};
