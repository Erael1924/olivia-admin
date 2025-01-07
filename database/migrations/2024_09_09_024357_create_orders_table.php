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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->index();
            $table->foreignId('customer_id')->index();
            $table->string('customer_name')->index();
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_province');
            $table->string('customer_zipcode');
            $table->foreignId('payment_method_id')->index();
            $table->foreignId('shipping_option_id')->index();
            $table->decimal('subtotal');
            $table->decimal('voucher_discount');
            $table->decimal('total');
            $table->decimal('shipping_fee');
            $table->decimal('shipping_discount');
            $table->decimal('shipping_discount_type');
            $table->unsignedBigInteger('status')->index()->default(2);
            $table->string('tracking_number')->index();
            $table->string('cancel_reason')->nullable();
            $table->foreignId('voucher_id')->index();
            $table->timestamp('paid_at')->index();
            $table->timestamp('shipped_at')->index();
            $table->timestamp('delivered_at')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
