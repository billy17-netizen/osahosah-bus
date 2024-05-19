<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bus_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses');
            $table->string('model'); //example: 2021
            $table->string('color'); //example: red
            $table->integer('manufacturing_year'); //example: 2020
            $table->boolean('wifi'); //example: true
            $table->boolean('ac'); //example: true
            $table->boolean('dinner'); //example: true
            $table->text('about_the_bus'); //example: this is a bus
            $table->text('essentials'); //example: this is a bus
            $table->text('snacks'); //example: this is a bus
            $table->text('safety_features'); //example: this is a bus
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_details');
    }
};
