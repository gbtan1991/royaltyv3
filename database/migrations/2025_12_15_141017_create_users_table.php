<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Access and Audit fields
            $table->string('access_key', 32)->unique()->nullable()->comment('For unauthenticated user lookup');
            $table->boolean('is_active')->default(true);

            // created_at & updated_at
            $table->timestamps(); 
        });

        
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
