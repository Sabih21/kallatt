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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();                                       
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();    
            $table->string('zip')->nullable();
            $table->string('product_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('product_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('cart_id')->nullable();
            $table->string('image_path')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();                                           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
