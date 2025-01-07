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
        Schema::create('shipping_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->string('carrier')->index();
            $table->string('service_level')->index();
            $table->string('estimated_delivery_time');
            $table->decimal('handling_fee');
            $table->string('is_international')->index();
            $table->unsignedSmallInteger('status')->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_options');
    }
};
