<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('bus_id')->constrained()->onDelete('cascade');
            $table->integer('punctuality_rating'); // 1-5
            $table->integer('services_staff_rating'); // 1-5
            $table->integer('cleanliness_rating'); // 1-5
            $table->integer('comfort_rating'); // 1-5
            $table->text('comment'); // optional
            $table->enum('is_approved', [0, 1, 2])->default(2); // 0: rejected, 1: approved, 2: pending
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejected_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
