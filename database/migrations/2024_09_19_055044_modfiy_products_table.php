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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_category_id')->after('category_id')->index();
            $table->decimal('weight')->after('tags');
            $table->decimal('width')->after('weight')->nullable();
            $table->decimal('length')->after('width')->nullable();
            $table->decimal('height')->after('length')->nullable();
            $table->smallInteger('has_variant')->after('length')->nullable();
            $table->decimal('price')->after('has_variant')->nullable();
            $table->decimal('stock')->after('price')->nullable();
            $table->decimal('sold')->after('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sub_category_id');
        });
    }
};
