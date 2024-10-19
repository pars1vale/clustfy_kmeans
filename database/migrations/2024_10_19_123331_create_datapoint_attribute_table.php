<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datapoint_attribute', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datapoint_id');
            $table->unsignedBigInteger('attribute_id');
            $table->float('value'); // Nilai dari atribut untuk setiap datapoint
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('datapoint_id')->references('id')->on('datapoint')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attribute')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datapoint_attribute');
    }
};
