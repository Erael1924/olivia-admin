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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code')->unique()->index();
            $table->string('description');
            $table->enum('discount_type', ['fixed_amount', 'percentage'])->index();
            $table->integer('amount');
            $table->integer('minimum_spend')->nullable();
            $table->integer('capped')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('applies_to', ['all_products', 'selected_collection', 'selected_category', 'selected_products'])->index();
            $table->unsignedBigInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
