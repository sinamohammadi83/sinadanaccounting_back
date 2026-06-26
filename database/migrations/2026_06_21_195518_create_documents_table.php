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
        Schema::create('documents', function (Blueprint $table) {
            $table->id()->startingValue(100000);
            $table->date('date');
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('accept_staff_id')->nullable()->constrained('staff');
            $table->foreignId('factor_id')->nullable()->comment('فاکتور')->constrained();
            $table->string('description',255);
            $table->string('type',1);
            $table->string('status',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
