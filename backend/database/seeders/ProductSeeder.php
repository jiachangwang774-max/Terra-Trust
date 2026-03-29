<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 创建供应商用户
        $supplier = User::firstOrCreate([
            'username' => 'supplier1',
            'password' => bcrypt('123456'),
            'phone' => '13800138001',
            'email' => 'supplier1@example.com',
            'role' => 'supplier',
            'real_name' => '供应商1',
            'address' => '北京市朝阳区'
        ]);

        // 创建测试商品
        Product::create([
            'product_name' => '有机蔬菜礼盒',
            'description' => '新鲜有机蔬菜，无农药残留',
            'price' => 88.00,
            'stock' => 100,
            'unit' => '盒',
            'category' => '蔬菜',
            'supplier_id' => $supplier->id
        ]);

        Product::create([
            'product_name' => '新鲜水果套餐',
            'description' => '精选时令水果',
            'price' => 128.00,
            'stock' => 50,
            'unit' => '份',
            'category' => '水果',
            'supplier_id' => $supplier->id
        ]);

        Product::create([
            'product_name' => '生态大米',
            'description' => '无污染生态种植大米',
            'price' => 68.00,
            'stock' => 200,
            'unit' => '袋',
            'category' => '粮油',
            'supplier_id' => $supplier->id
        ]);
    }
}