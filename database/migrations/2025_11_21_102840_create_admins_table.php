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
            
            $table->string('username')->unique();
            $table->string('password_hash'); 
            $table->enum('role', ['superadmin', 'admin'])->default('admin');

        // New recommended production-level fields
            $table->string('email')->unique()->nullable();
            $table->enum('status', ['active', 'inactive', 'locked'])->default('active');

        // Profile fields
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();

        // Security logs
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->integer('login_attempts')->nullable();
            $table->timestamp('locked_until')->nullable();

        // Password reset system
            $table->string('password_reset_token')->nullable();
            $table->timestamp('password_reset_sent_at')->nullable();

        // Laravel Timestamps
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
