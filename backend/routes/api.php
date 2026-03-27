<?php

use App\Http\Controllers\LxController;
use App\Http\Controllers\WjcController;
use Illuminate\Support\Facades\Route;

// 公开接口（不需要认证）
Route::prefix('v1')->group(function () {
    Route::post('/register', [LxController::class, 'register']);//用户注册
    Route::post('/login', [LxController::class, 'login']);//用户登录

    // 商品公开接口
    Route::get('/products', [LxController::class, 'productList']);//商品列表
    Route::get('/products/{id}', [LxController::class, 'productDetail']);//商品详情
});

// 需要认证的接口
Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    // 用户接口
    Route::post('/reset-password', [LxController::class, 'resetPassword']);//重置密码
    Route::get('/profile', [LxController::class, 'profile']);//用户信息
    Route::put('/profile', [LxController::class, 'updateProfile']);//更新用户信息

    // 商品供应商接口
    Route::post('/products', [LxController::class, 'storeProduct']);//创建商品
    Route::put('/products/{id}', [LxController::class, 'updateProduct']);//更新商品
    Route::put('/products/{id}/stock', [LxController::class, 'updateStock']);//更新商品库存

    // 订单接口
    Route::post('/orders', [WjcController::class, 'storeOrder']);//创建订单
    Route::get('/consumer/orders', [WjcController::class, 'consumerOrderList']);//消费者订单列表
    Route::get('/purchaser/orders/pending', [WjcController::class, 'purchaserPendingOrders']);//采购订单待处理列表
    Route::put('/purchaser/orders/{order}/accept', [WjcController::class, 'acceptOrder']);//采购订单接受
    Route::put('/orders/{order}/status', [WjcController::class, 'updateOrderStatus']);//更新订单状态
    Route::get('/orders/{order}', [WjcController::class, 'showOrder']);//订单详情

    // 抽检接口
    Route::post('/inspections', [WjcController::class, 'storeInspection']);//创建抽检
    Route::get('/purchaser/inspections', [WjcController::class, 'purchaserInspectionList']);//采购抽检抽检列表
    Route::get('/orders/{order}/inspection', [WjcController::class, 'showInspectionByOrder']);//订单抽检详情
});
