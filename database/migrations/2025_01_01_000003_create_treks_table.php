<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('days')->default(1);
            $table->string('grade')->default('Easy');
            $table->string('season')->default('Summer');
            $table->string('short_text')->nullable();
            $table->text('overview')->nullable();
            $table->text('highlights')->nullable();
            $table->string('base_camp')->nullable();
            $table->unsignedInteger('max_altitude')->nullable();
            $table->unsignedSmallInteger('distance_km')->nullable();
            $table->string('best_months')->nullable();
            $table->string('interest')->default('Trekking');
            $table->string('themes')->nullable();
            $table->string('experiences')->nullable();
            $table->text('itinerary')->nullable();
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->text('essentials')->nullable();
            $table->text('cancellation')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->string('price_note')->nullable();
            $table->string('badge')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->unsignedInteger('rating_count')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('trek_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trek_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('departures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trek_id')->constrained()->cascadeOnDelete();
            $table->date('start_date');
            $table->unsignedSmallInteger('seats_left')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departures');
        Schema::dropIfExists('trek_images');
        Schema::dropIfExists('treks');
    }
};
