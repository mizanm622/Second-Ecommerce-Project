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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->integer('childcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('pickup_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('code');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('unit')->nullable();
            $table->string('tags')->nullable();
            $table->string('video')->nullable();
            $table->string('purches_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('stack_quantity')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->string('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('view_count')->nullable();
            $table->integer('trending')->nullable();
            $table->integer('product_slider')->nullable();
            $table->integer('todays_deal')->nullable();
            $table->integer('status')->nullable();
            $table->integer('flash_deal_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('cash_on_delivery')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
