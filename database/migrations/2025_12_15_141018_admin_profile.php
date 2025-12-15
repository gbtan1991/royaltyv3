<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_profile', function (Blueprint $table) {
            // User ID is the Primary Key AND the Foreign Key for the 1:1 relationship
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');

            // Authentication Specifics
            $table->string('username', 50)->unique()->nullable(false);
            $table->string('password_hash')->nullable(false);
            $table->integer('employee_id')->nullable();

            // Role Specifics
            $table->enum('role', ['superadmin', 'admin']);
            $table->enum('status', ['active', 'suspended', 'deactivated'])->default('active');

            // Audit Fields
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};


