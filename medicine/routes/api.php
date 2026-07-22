<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WJC\ReminderController;
use App\Http\Controllers\WJC\RecordController;
use App\Http\Controllers\WJC\RelativeController;
use App\Http\Controllers\WJC\NoticeController;
use App\Http\Controllers\WJC\DrugLibraryController;
use App\Http\Controllers\WJC\HealthController;
use App\Http\Controllers\WJC\CommonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 公共接口（无需登录）
Route::prefix('v1')->group(function () {
    Route::post('relatives/login', [RelativeController::class, 'login']);
    Route::get('common/config', [CommonController::class, 'config']);
    Route::get('drugLib/search', [DrugLibraryController::class, 'search']);
    Route::get('drugLib/{libId}', [DrugLibraryController::class, 'detail']);
});

// 需要登录的接口
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {

    // ========== 5. 服药提醒接口 ==========
    Route::post('reminders', [ReminderController::class, 'store']);
    Route::get('reminders/today', [ReminderController::class, 'today']);
    Route::get('reminders/all', [ReminderController::class, 'allList']);
    Route::get('reminders/{id}', [ReminderController::class, 'detail']);
    Route::put('reminders/{id}', [ReminderController::class, 'update']);
    Route::delete('reminders/{id}', [ReminderController::class, 'delete']);
    Route::post('reminders/{id}/take', [ReminderController::class, 'take']);
    Route::put('reminders/batchStatus', [ReminderController::class, 'batchStatus']);

    // ========== 6. 服药记录接口 ==========
    Route::get('records', [RecordController::class, 'byDate']);
    Route::get('records/monthStat', [RecordController::class, 'monthStat']);
    Route::get('records/miss', [RecordController::class, 'missList']);
    Route::get('records/export', [RecordController::class, 'export']);
    Route::get('records/{id}', [RecordController::class, 'detail']);

    // ========== 7. 亲属管理接口 ==========
    Route::post('relatives/bind', [RelativeController::class, 'bind']);
    Route::get('relatives', [RelativeController::class, 'list']);
    Route::delete('relatives/{bindId}', [RelativeController::class, 'unbind']);
    Route::put('relatives/{bindId}/permission', [RelativeController::class, 'updatePermission']);
    Route::get('relatives/user/{userId}/todayRemind', [RelativeController::class, 'userTodayRemind']);

    // ========== 8. 消息通知接口 ==========
    Route::get('notice/list', [NoticeController::class, 'list']);
    Route::put('notice/{id}/read', [NoticeController::class, 'read']);
    Route::put('notice/readAll', [NoticeController::class, 'readAll']);
    Route::delete('notice/{id}', [NoticeController::class, 'delete']);

    // ========== 10. 健康档案接口 ==========
    Route::post('health', [HealthController::class, 'store']);
    Route::get('health', [HealthController::class, 'list']);
    Route::delete('health/{id}', [HealthController::class, 'delete']);

    // ========== 11. 通用接口 ==========
    Route::post('common/upload', [CommonController::class, 'upload']);
});
