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
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('artikul');
            $table->decimal('price')->default(0);
            $table->decimal('old_price')->default(0);
            $table->string('image');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->index('category_id', 'category_id_idx');
            $table->foreign('category_id', 'category_id_fk')->on('catalog_categories')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_products');
    }
};
