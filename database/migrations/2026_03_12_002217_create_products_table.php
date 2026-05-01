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
            $table->foreignId("storage_id")->constrained();
            $table->foreignId("category_id")->constrained();
            $table->foreignId("staff_id")->constrained();
            $table->string("name",255);
            $table->unsignedBigInteger("sell_price");
            $table->unsignedBigInteger("buy_price");
            $table->string("pic",255);
            $table->integer("count");
            $table->timestamps();

            $table->unique(['storage_id','name']);
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
