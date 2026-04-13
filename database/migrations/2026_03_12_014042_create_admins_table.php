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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("name",15)->comment("نام");
            $table->string("family",15)->comment("نام خانوادگی");
            $table->string("mobile",11)->comment("موبایل");
            $table->string("admin_code",10)->comment("کد مدیریت");
            $table->string("national_code",11)->comment("کد ملی");
            $table->string("education",15)->comment("تحصیلات");
            $table->string("role",15)->comment("سمت");
            $table->string("father_name",15)->comment("نام پدر");
            $table->string("address",255)->comment("آدرس");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
