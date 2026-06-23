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
        Schema::create('factor_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("factor_id")->comment("فاکتور")->constrained();
            $table->foreignId("product_id")->comment("کالا")->constrained();
            $table->foreignId('storage_id')->comment('انبار')->constrained();
            $table->string("description",255)->nullable()->comment("توضیحات");
            $table->string("unit",10)->comment("واحد");
            $table->integer("count")->comment("تعداد");
            $table->unsignedBigInteger("unit_price")->comment("قیمت پایه");
            $table->unsignedBigInteger("discount")->comment("تخفیف");
            $table->unsignedBigInteger("tax")->comment("مالیات");
            $table->unsignedBigInteger("total_price")->comment("قیمت کل");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factor_products');
    }
};
