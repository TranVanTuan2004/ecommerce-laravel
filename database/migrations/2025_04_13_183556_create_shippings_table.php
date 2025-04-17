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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('carrier', 100)->nullable(); // ví dụ: Giao hàng nhanh, Viettel Post
            $table->enum('status', ['pending', 'shipped', 'in_transit', 'delivered', 'cancelled'])->default('pending');
            $table->date('estimated_delivery')->nullable(); // ngày giao dự kiến
            $table->date('delivered_at')->nullable(); // ngày đã giao (thực tế)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
