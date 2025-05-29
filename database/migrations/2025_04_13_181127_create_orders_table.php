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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->text('shipping_address')->nullable();

            // Thêm voucher
            $table->string('voucher_code', 50)->nullable(); // Mã voucher
            $table->decimal('discount_price', 12, 2)->default(0); // Số tiền được giảm

            $table->decimal('price', 12, 2)->default(0);
            $table->string('payment_method', 100);
            $table->string('status', 50)->default('pending');
            $table->timestamp('ordered_at')->nullable();
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
