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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->index();
            $table->string('sku')->index();
            $table->string('first_option')->index();
            $table->string('second_option')->index();
            $table->decimal('stock')->nullable();
            $table->decimal('sold')->nullable();
            $table->decimal('price');
            $table->smallInteger('level');
            $table->unsignedBigInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
