<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('order_code')->unique();
            $table->text('note')->nullable();
            $table->decimal('total_price', 18, 0);
            $table->enum('status', ['pending', 'success', 'cancel', 'refund', 'shipping']);
            $table->enum('payment_method', ['bank_transfer', 'cash_on_delivery', 'paypal', 'vnpay', 'momo']);
            $table->uuid('orderer_id');
            $table->date('estimated_delivery')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('orderer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
