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
        Schema::create('customer_total_balance', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('company');
            $table->decimal('deposit', 10, 2);
            $table->decimal('credit', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_total_balance');
    }
};
