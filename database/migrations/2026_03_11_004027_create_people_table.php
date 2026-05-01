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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId("province_id")->comment("استان")->constrained();
            $table->foreignId("city_id")->comment("شهر")->constrained();
            $table->foreignId("branch_id")->comment("شعبه")->constrained();
            $table->string("first_name",15)->comment("نام");
            $table->string("last_name",15)->comment("نام خانوادگی");
            $table->string("community",100)->nullable()->comment("شرکت");
            $table->string("mobile",11)->unique()->comment("موبایل");
            $table->string("tel",11)->nullable()->comment("تلفن");
            $table->string("postal_code",10)->comment("کد پستی");
            $table->string("email",30)->nullable()->comment("ایمیل");
            $table->string("website",50)->nullable()->comment("وبسایت");
            $table->string("address",255)->nullable()->comment("آدرس");
            $table->string("pic",10)->nullable()->comment("عکس");
            $table->integer("type")->comment("نوع");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
