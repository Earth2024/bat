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
        if(!Schema::hasTable('bot_transactions')){
            Schema::create('bot_transactions', function (Blueprint $table) {
                $table->id();
                $table->string('symbol');
                $table->double('lot');
                $table->string('status')->default('pending');
                $table->double('sl')->nullable();
                $table->double('tp')->nullable();
                $table->double('tsl')->nullable();
                $table->string('ticket')->nullable();
                $table->double('price')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->enum('type', ['buy', 'sell'])->nullable();
                $table->string('placed_time')->nullable();
                $table->string('pnl')->nullable();
                $table->foreignId('bot_account_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_transactions');
    }
};
