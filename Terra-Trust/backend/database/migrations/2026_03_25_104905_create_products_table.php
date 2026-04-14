<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); // 商品名称
            $table->text('description')->nullable(); // 商品描述
            $table->decimal('price', 10, 2); // 单价
            $table->integer('stock'); // 库存
            $table->string('unit'); // 计量单位
            $table->string('category')->nullable(); // 分类
            $table->foreignId('supplier_id')->constrained('users'); // 供应商ID
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};