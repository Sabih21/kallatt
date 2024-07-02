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

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullabe();
            $table->string('address')->nullabe();
            $table->string('city')->nullable();
            $table->string('shop')->nullable();
            $table->string('user_id')->nullabe();
            $table->string('product_name')->nullabe();
            $table->string('quantity')->nullabe();
            $table->string('price')->nullabe()->nullable();
            $table->string('company_name')->nullable();
            $table->string('image_path')->nullabe();
            $table->string('product_id')->nullabe();
            $table->string('payment_status')->nullabe();
            $table->string('delivery_status')->nullabe();

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
