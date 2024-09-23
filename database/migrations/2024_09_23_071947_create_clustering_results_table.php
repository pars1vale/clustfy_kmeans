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
        Schema::create('clustering_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datapoint_id');
            $table->unsignedBigInteger('centroid_id');
            $table->integer('cluster_number');
            $table->double('distance', 15, 8);
            $table->timestamps();

            $table->foreign('datapoint_id')->references('id')->on('datapoint')->onDelete('cascade');
            $table->foreign('centroid_id')->references('id')->on('centroid')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clustering_results');
    }
};
