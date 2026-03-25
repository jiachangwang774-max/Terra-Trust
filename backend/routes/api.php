use App\Http\Controllers\OrderInspectionController;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
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