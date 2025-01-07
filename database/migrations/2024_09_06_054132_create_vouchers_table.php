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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code')->unique()->index();
            $table->string('description');
            $table->enum('voucher_type', ['fixed_amount', 'percentage'])->index();
            $table->integer('amount');
            $table->integer('minimum_spend')->nullable();
            $table->integer('capped')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('maximum_redemption')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('applies_to', ['total_amount', 'shipping_fee'])->index();
            $table->unsignedBigInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
