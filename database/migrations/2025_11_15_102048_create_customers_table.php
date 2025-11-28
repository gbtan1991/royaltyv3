<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            // Identity
            $table->string('username')->unique();

            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->enum('status', ['active', 'inactive', 'banned'])->default('inactive');

            // Rewards / Points
            $table->unsignedInteger('total_points')->default(0);

            // Timestamps
            $table->timestamps();           // created_at, updated_at
            $table->softDeletes();          // deleted_at (for soft deleting)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
