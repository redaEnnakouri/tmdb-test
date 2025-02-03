<?php

use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('film_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Film::class)->constrained()->cascadeOnDelete();
            $table->string('runtime')->nullable();
            $table->string('status')->nullable();
            $table->string('tagline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_details');
    }
};
