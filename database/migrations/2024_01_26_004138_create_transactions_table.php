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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); 
            $table->string('address')->nullable();
            $table->string('town_city')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('order_notes')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('subtotal')->nullable();
            $table->boolean('shipping')->default(false);
            $table->string('payment_method')->nullable();
            $table->timestamps();
    
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
