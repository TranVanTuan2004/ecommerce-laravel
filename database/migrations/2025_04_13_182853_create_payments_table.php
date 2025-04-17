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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);  // Số tiền thanh toán
            $table->enum('payment_method', ['vnpay', 'momo', 'paypal', 'cod']);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('transaction_id')->nullable(); // dùng để lưu mã giao dịch từ vnpay/momo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
