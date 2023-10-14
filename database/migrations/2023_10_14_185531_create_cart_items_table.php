<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->uuid('uuid')->unique();

            $table->foreignId('cart_uuid')->constrained();

            $table->foreignId('product_id')->constrained();

            $table->integer('amount');
            $table->integer('price_per_item_excluding_vat');
            $table->integer('price_per_item_including_vat');
            $table->integer('vat_percentage');
            $table->integer('vat_price');
            $table->integer('total_item_price_excluding_vat');
            $table->integer('total_item_price_including_vat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
