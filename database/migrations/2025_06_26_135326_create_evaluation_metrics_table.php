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
        if(!Schema::hasTable('evaluation_metrics')){
            Schema::create('evaluation_metrics', function (Blueprint $table) {
                $table->id();
                $table->foreignId('evaluation_account_id')->constrained()->onDelete('cascade');
                $table->decimal('profit', 15, 2)->default(0);
                $table->decimal('max_drawdown', 15, 2)->nullable();
                $table->decimal('drawdown', 15, 2)->nullable();
                $table->integer('trades_count')->default(0);
                $table->boolean('rules_violated')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_metrics');
    }
};
