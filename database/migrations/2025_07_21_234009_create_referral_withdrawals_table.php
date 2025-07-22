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
        if(!Schema::hasTable('referral_withdrawals')){
            Schema::create('referral_withdrawals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('referral_account_id')->nullable()->constrained()->onDelete('cascade');
                $table->string('type')->default('withdrawal');
                $table->decimal('amount', 7, 2)->nullable(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_withdrawals');
    }
};
