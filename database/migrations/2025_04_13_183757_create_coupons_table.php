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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // id INT PRIMARY KEY IDENTITY(1,1)
            $table->string('code', 50)->unique(); // code NVARCHAR(50) UNIQUE NOT NULL
            $table->decimal('discount', 5, 2);    // discount DECIMAL(5,2) NOT NULL
            $table->decimal('min_order_value', 10, 2)->nullable(); // min_order_value DECIMAL(10,2)
            $table->date('expiration_date');      // expiration_date DATE NOT NULL
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
