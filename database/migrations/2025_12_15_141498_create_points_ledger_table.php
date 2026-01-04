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
        Schema::create('points_ledger', function (Blueprint $table) {
            $table->id();

            // --- FK to the users table (The person whose balance is affected) ---
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict');
            
            // --- The core value ---
            // Positive for earned/credit (TRANSACTION, BONUS), Negative for spent/debit (CLAIM, EXPIRATION)
            $table->integer('points_amount')->comment('Positive for credit, Negative for debit');
            
            // --- Source of the movement (For auditing and reporting) ---
            $table->enum('source_type', ['TRANSACTION', 'CLAIM', 'BONUS', 'EXPIRATION', 'ADJUSTMENT']);
            
            // ID of the related transaction, claim, or adjustment record
            $table->unsignedBigInteger('source_id')->nullable(); 
            
            $table->string('description')->nullable();
            $table->timestamp('ledger_date')->useCurrent();
            
            // --- Performance Indexing (CRITICAL for balance calculation) ---
            // Index to drastically speed up the SUM(points_amount) GROUP BY user_id query.
            $table->index('user_id');
            $table->index(['user_id', 'ledger_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_ledger');
    }
};
