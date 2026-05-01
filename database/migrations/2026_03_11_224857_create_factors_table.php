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
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->foreignId("branch_id")->comment("شعبه")->constrained();
            $table->foreignId("staff_id")->comment("کارمند")->constrained();
            $table->foreignId("category_id")->comment("دسته بندی")->constrained();
            $table->foreignId("person_id")->comment("شخص")->constrained();
            $table->string("title",50)->unique()->comment("عنوان");
            $table->date("date")->comment("تاریخ");
            $table->date("due_date")->comment("تاریخ سررسید");
            $table->unsignedBigInteger("paid_price")->comment("هزینه پرداخت شده");
            $table->unsignedBigInteger("total_price")->comment("هزینه کل");
            $table->boolean("type")->comment("0 خرید 1 فروش");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factors');
    }
};
