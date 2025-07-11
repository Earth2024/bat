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
        if(!Schema::hasTable('transactions')){
                Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('account_id')->nullable()->constrained()->onDelete('cascade');
                $table->enum('type', ['deposit', 'withdrawal', 'bot', 'option', 'contest', 'evaluation', 'transfer']);
                $table->string('signature')->unique()->nullable();
                $table->string('address')->nullable();
                $table->string('sender')->nullable();
                $table->string('receiver')->nullable();
                $table->decimal('amount', 18, 3); // SOL
                $table->timestamp('block_time')->nullable();
                $table->decimal('profit', 18, 3)->nullable();
                $table->json('meta_data')->nullable(); // store service or bill details
                $table->timestamps();
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
