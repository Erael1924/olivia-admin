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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->index();
            $table->foreignId('customer_id')->index();
            $table->string('subject')->index();
            $table->string('description')->index();
            $table->string('category')->index();
            $table->string('priority_level')->index();
            $table->unsignedSmallInteger('status')->default(5);
            $table->foreignId('assigned_to')->constrained('users')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
