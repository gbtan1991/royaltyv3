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
    Schema::table('points_ledger', function (Blueprint $table) {
        // Only add these if they don't exist in your table yet
        if (!Schema::hasColumn('points_ledger', 'source_type')) {
            $table->enum('source_type', ['TRANSACTION', 'CLAIM', 'BONUS', 'EXPIRATION', 'ADJUSTMENT'])->after('points_amount');
        }
        if (!Schema::hasColumn('points_ledger', 'source_id')) {
            $table->unsignedBigInteger('source_id')->nullable()->after('source_type');
        }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('points_ledger', function (Blueprint $table) {
            $table->dropColumn(['transaction_type', 'description']);
        });
    }
};