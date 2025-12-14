<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->integer('user_id');
            $table->enum('loyalty_tier', ['bronze', 'silver', 'gold', 'platinum'])->nullable();
            $table->integer('registered_by_admin_user_id')->nullable();
            $table->timestmap('last_activity_at')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('registered_by_admin_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
