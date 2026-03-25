use App\Http\Controllers\LxController;
use App\Http\Controllers\OrderInspectionController;

// 公开接口（不需要认证）
Route::prefix('v1')->group(function () {
    Route::post('/register', [LxController::class, 'register']);
    Route::post('/login', [LxController::class, 'login']);
    
    // 商品公开接口
    Route::get('/products', [LxController::class, 'productList']);
    Route::get('/products/{id}', [LxController::class, 'productDetail']);
});

// 需要认证的接口
Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    // 用户接口
    Route::post('/reset-password', [LxController::class, 'resetPassword']);
    Route::get('/profile', [LxController::class, 'profile']);
    Route::put('/profile', [LxController::class, 'updateProfile']);
    
    // 商品供应商接口
    Route::post('/products', [LxController::class, 'storeProduct']);
    Route::put('/products/{id}', [LxController::class, 'updateProduct']);
    Route::put('/products/{id}/stock', [LxController::class, 'updateStock']);
    // 订单接口
    Route::post('/orders', [OrderInspectionController::class, 'storeOrder']);
    Route::get('/consumer/orders', [OrderInspectionController::class, 'consumerOrderList']);
    Route::get('/purchaser/orders/pending', [OrderInspectionController::class, 'purchaserPendingOrders']);
    Route::put('/purchaser/orders/{order}/accept', [OrderInspectionController::class, 'acceptOrder']);
    Route::put('/orders/{order}/status', [OrderInspectionController::class, 'updateOrderStatus']);
    Route::get('/orders/{order}', [OrderInspectionController::class, 'showOrder']);

    // 抽检接口
    Route::post('/inspections', [OrderInspectionController::class, 'storeInspection']);
    Route::get('/purchaser/inspections', [OrderInspectionController::class, 'purchaserInspectionList']);
    Route::get('/orders/{order}/inspection', [OrderInspectionController::class, 'showInspectionByOrder']);
});