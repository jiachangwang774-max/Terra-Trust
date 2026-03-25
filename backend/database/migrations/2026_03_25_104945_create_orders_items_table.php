<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id')->comment('订单项ID');
            $table->bigInteger('order_id')->comment('所属订单ID');
            $table->bigInteger('product_id')->comment('商品ID');
            $table->integer('quantity')->comment('购买数量');
            $table->decimal('unit_price', 10, 2)->comment('下单时商品单价');
            
            // 外键约束
            $table->foreign('order_id')
                  ->references('order_id')
                  ->on('orders')
                  ->onDelete('cascade');
            
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onDelete('cascade');
            
            $table->comment('订单商品明细表');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};