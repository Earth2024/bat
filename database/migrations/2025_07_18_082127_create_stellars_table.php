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
        if(!Schema::hasTable('stellars')){
            Schema::create('stellars', function (Blueprint $table) {
                $table->id();
                $table->string('public_key')->unique();
                $table->string('secret_key');
                $table->boolean('funded')->default(false);
                $table->json('friendbot_response')->nullable();
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stellars');
    }
};
