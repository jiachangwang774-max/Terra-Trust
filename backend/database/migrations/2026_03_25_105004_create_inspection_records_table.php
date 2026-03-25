<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inspection_records', function (Blueprint $table) {
            $table->bigIncrements('inspection_id')->comment('抽检记录ID');
            $table->bigInteger('order_id')->unique()->comment('关联订单ID');
            $table->bigInteger('purchaser_id')->comment('执行抽检的采购商ID');
            $table->enum('result', ['qualified', 'unqualified'])->comment('抽检结果');
            $table->dateTime('inspection_time')->comment('抽检时间');
            $table->text('remarks')->nullable()->comment('抽检备注');
            $table->dateTime('created_at')->useCurrent()->comment('记录创建时间');

            // 外键约束
            $table->foreign('order_id')
                  ->references('order_id')
                  ->on('orders')
                  ->onDelete('cascade');
            
            $table->foreign('purchaser_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->comment('抽检记录表');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inspection_records');
    }
};
