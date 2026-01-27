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
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('reward_id')->constrained('rewards')->onDelete('restrict');
            $table->integer('points_spent');
            $table->string('status')->default('completed'); // useful for 'pending' or 'cancelled' later
            $table->timestamps();
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
