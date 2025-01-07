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
        Schema::create('return_orders', function (Blueprint $table) {
            $table->id();
            $table->string('return_number')->index();
            $table->foreignId('order_id')->index();
            $table->string('customer_name')->index();
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_province');
            $table->string('customer_zipcode');
            $table->enum('return_type', ['return_only', 'return_refund'])->index();
            $table->decimal('refund_amount');
            $table->unsignedBigInteger('status')->index()->default(8);
            $table->string('tracking_number')->index();
            $table->string('cancel_reason')->nullable();
            $table->timestamp('approved_at')->index();
            $table->timestamp('shipped_at')->index();
            $table->timestamp('completed_at')->index();
            $table->timestamp('declined_at')->index();
            $table->timestamp('cancelled_at')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_orders');
    }
};
