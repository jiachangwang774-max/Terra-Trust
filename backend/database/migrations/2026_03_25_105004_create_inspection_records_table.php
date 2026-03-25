<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained(); // 关联订单ID
            $table->foreignId('purchaser_id')->constrained('users'); // 操作的采购商ID
            $table->string('result'); // qualified / unqualified
            $table->dateTime('inspection_time'); // 抽检时间
            $table->text('remarks')->nullable(); // 备注
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_records');
    }
};