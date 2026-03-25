<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumer_id')->constrained('users'); // 消费者ID
            $table->foreignId('purchaser_id')->nullable()->constrained('users'); // 接单采购商ID
            $table->decimal('total_amount', 10, 2); // 订单总金额
            $table->string('status')->default('pending'); // 订单状态
            $table->text('shipping_address'); // 收货地址
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};