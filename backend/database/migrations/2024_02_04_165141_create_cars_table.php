<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('year');
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('cylinders');
            $table->double('displacement');
            $table->string('drive');
            $table->string('fuel_type');
            $table->integer('city_mpg');
            $table->integer('highway_mpg');
            $table->integer('combination_mpg');
            $table->string('transmission');
            $table->timestamps();

            // Foreign keys
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
