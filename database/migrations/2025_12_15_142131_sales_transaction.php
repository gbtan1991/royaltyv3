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
        Schema::create('sales_transaction', function (Blueprint $table){
            $table->id();

            // --- FKs to the users table (The parties are involved in the transaction) ---
            $table->foreignId('customer_user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('admin_user_id')->nullable()->constrained('users')->onDelete('set null');


            // --- Financial Details ---
            $table->decimal('amount', 10, 2);
            $table->timestamp('transaction_date')->useCurrent();

            // --- FK to the loyalty ledger ---
            $table->foreignId('points_ledger_id')->nullable()->constrained('points_ledger')->onDelete('set null');
            
            $table->timestamps();

            $table->index('transaction_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_transaction');
    }
};
