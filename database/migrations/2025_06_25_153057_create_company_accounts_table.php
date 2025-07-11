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
        if(!Schema::hasTable('company_accounts')){
            Schema::create('company_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->default('nigakool@gmail.com');
            $table->decimal('balance', 12, 2)->default(0.00);
            $table->timestamps();
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_accounts');
    }
};
