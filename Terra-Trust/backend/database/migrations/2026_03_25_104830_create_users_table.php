<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // 用户名
            $table->string('password'); // 密码
            $table->string('phone')->nullable()->unique(); // 手机号
            $table->string('email')->nullable()->unique(); // 邮箱
            $table->string('role'); // 角色：consumer/supplier/purchaser/admin
            $table->string('real_name')->nullable(); // 真实姓名
            $table->text('address')->nullable(); // 联系地址
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};