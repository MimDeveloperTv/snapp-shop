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
        Schema::create('wage_transactions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('source_card_id')->index()->constrained('cards')->cascadeOnDelete();
            $table->decimal('amount', 64, 0)->index();
            $table->timestamp('created_at', 6)->nullable();


            $table->index('created_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wage_transactions');
    }
};
