<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('customer_profile', function (Blueprint $table) {
            // User ID is the Primary Key AND the Foreign Key for the 1:1 relationship
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            
            // Loyalty Specifics
            $table->integer('member_id')->unique()->nullable();
            $table->enum('loyalty_tier', ['Bronze', 'Silver', 'Gold'])->default('Bronze');
            $table->timestamp('last_activity_at')->nullable();

            // Audit Field: Who created this customer account
            $table->foreignId('registered_by_admin_user_id')
                  ->nullable()
                  ->constrained('users')
                  ->comment('FK to the users.id of the admin who registered this customer');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_profile');
    }
};
