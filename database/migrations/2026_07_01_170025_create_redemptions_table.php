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
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->foreignId('reward_id')->constrained('rewards')->restrictOnDelete();
            $table->foreignId('redeemed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('points_spent');
            $table->enum('status', ['completed', 'cancelled'])->default('completed');
            $table->timestamps();

            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};
