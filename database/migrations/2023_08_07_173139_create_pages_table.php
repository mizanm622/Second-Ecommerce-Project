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
        Schema::create('pages', function (Blueprint $table)  {
            $table->id();
            $table->integer('page_position')->nullable();
            $table->string('page_name')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('page_title')->nullable();
            $table->text('page_description')->nullable();
            $table->string('heading_one')->nullable();
            $table->text('description_one')->nullable();
            $table->string('image_one')->nullable();
            $table->string('heading_two')->nullable();
            $table->text('description_two')->nullable();
            $table->string('image_two')->nullable();
            $table->string('heading_three')->nullable();
            $table->text('description_three')->nullable();
            $table->string('image_three')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
