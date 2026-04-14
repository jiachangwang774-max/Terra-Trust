<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\InspectionRecord;

class WjcController extends \Illuminate\Routing\Controller
{
    //订单模块

    //消费者创建订单

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // 模拟用户 ID
        $userId = 1;
        $data = $validated;

        $totalAmount = collect($data['items'])->sum(function($item){
            return $item['quantity'] * 5.99;
        });

        // 模拟订单创建
        $orderId = rand(1000, 9999);

        return response()->json([
            'code' => 200,
            'message' => '订单创建成功',
            'data' => [
                'order_id' => $orderId,   
                'total_amount' => $totalAmount,
            ],
        ]);
    }

    //查询消费者订单列表

    public function consumerOrderList(Request $request)
    {
        $user = $request->user();
        $query = Order::where('consumer_id', $user->id);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(
            $request->input('size', 10),
            ['*'],
            'page',
            $request->input('page', 1)
        );

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'total' => $orders->total(),
                'page' => $orders->currentPage(),
                'size' => $orders->perPage(),
                'list' => $orders->map(function ($order) {
                    return [
                        'order_id' => $order->id,
                        'total_amount' => $order->total_amount,
                        'status' => $order->status,
                        'created_at' => $order->created_at->toDateTimeString(),
                    ];
                }),
            ],
        ]);
    }

    //查询待接单订单（采购商）

    public function purchaserPendingOrders(Request $request)
    {
        // 模拟待接单订单数据
        $orders = [
            [
                'id' => 1,
                'total_amount' => 199.99,
                'status' => 'pending',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'total_amount' => 299.99,
                'status' => 'pending',
                'created_at' => now()->subHour(),
            ],
            [
                'id' => 3,
                'total_amount' => 399.99,
                'status' => 'pending',
                'created_at' => now()->subDay(),
            ],
        ];

        // 模拟分页
        $size = $request->input('size', 10);
        $page = $request->input('page', 1);
        $total = count($orders);

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'total' => $total,
                'page' => $page,
                'size' => $size,
                'list' => array_map(function ($order) {
                    return [
                        'order_id' => $order['id'],
                        'total_amount' => $order['total_amount'],
                        'status' => $order['status'],
                        'created_at' => $order['created_at']->toDateTimeString(),
                    ];
                }, $orders),
            ],
        ]);
    }

    //采购商接单

    public function acceptOrder(Request $request, $orderId)
    {
        // 模拟接单操作
        return response()->json([
            'code' => 200,
            'message' => '接单成功',
            'data' => null,
        ]);
    }

    //订单状态更新

    public function updateOrderStatus(Request $request, $orderId)
    {
        $validated = $request->validate([
            'status' => 'required|string'
        ]);

        // 模拟状态更新
        return response()->json([
            'code' => 200,
            'message' => '订单状态更新成功',
            'data' => null,
        ]);
    }

    //查询订单详情

    public function showOrder($orderId)
    {
        // 模拟订单详情数据
        $order = [
            'id' => $orderId,
            'consumer_id' => 1,
            'purchaser_id' => 2,
            'total_amount' => 199.99,
            'status' => 'accepted',
            'shipping_address' => '四川省成都市xxx区xxx路',
            'created_at' => now(),
            'items' => [
                [
                    'product_id' => 1,
                    'product_name' => '商品1',
                    'quantity' => 2,
                    'unit_price' => 50.00,
                ],
                [
                    'product_id' => 2,
                    'product_name' => '商品2',
                    'quantity' => 1,
                    'unit_price' => 99.99,
                ],
            ],
        ];

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'order_id' => $order['id'],
                'consumer_id' => $order['consumer_id'],
                'purchaser_id' => $order['purchaser_id'],
                'total_amount' => $order['total_amount'],
                'status' => $order['status'],
                'shipping_address' => $order['shipping_address'],
                'created_at' => $order['created_at']->toDateTimeString(),
                'items' => $order['items'],
            ],
        ]);
    }

    // 抽检模块方法

    //提交抽检结果

    public function storeInspection(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'result' => 'required|string',
            'inspection_time' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        // 模拟抽检记录创建
        $inspectionId = rand(1000, 9999);

        return response()->json([
            'code' => 200,
            'message' => '抽检结果提交成功',
            'data' => ['inspection_id' => $inspectionId],
        ]);
    }

    //查询采购商抽检记录

    public function purchaserInspectionList(Request $request)
    {
        // 模拟抽检记录数据
        $inspections = [
            [
                'id' => 1,
                'order_id' => 1,
                'result' => 'qualified',
                'inspection_time' => now(),
                'remarks' => '抽检合格',
            ],
            [
                'id' => 2,
                'order_id' => 2,
                'result' => 'unqualified',
                'inspection_time' => now()->subDay(),
                'remarks' => '抽检不合格',
            ],
        ];

        // 模拟分页
        $size = $request->input('size', 10);
        $page = $request->input('page', 1);
        $total = count($inspections);

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'total' => $total,
                'page' => $page,
                'size' => $size,
                'list' => array_map(function ($inspection) {
                    return [
                        'inspection_id' => $inspection['id'],
                        'order_id' => $inspection['order_id'],
                        'result' => $inspection['result'],
                        'inspection_time' => $inspection['inspection_time']->toDateTimeString(),
                        'remarks' => $inspection['remarks'],
                    ];
                }, $inspections),
            ],
        ]);
    }

    //查询订单的抽检记录

    public function showInspectionByOrder($orderId)
    {
        // 模拟订单抽检记录
        $inspection = [
            'id' => 1,
            'order_id' => $orderId,
            'purchaser_id' => 2,
            'result' => 'qualified',
            'inspection_time' => now(),
            'remarks' => '抽检合格',
        ];

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'inspection_id' => $inspection['id'],
                'order_id' => $inspection['order_id'],
                'purchaser_id' => $inspection['purchaser_id'],
                'result' => $inspection['result'],
                'inspection_time' => $inspection['inspection_time']->toDateTimeString(),
                'remarks' => $inspection['remarks'],
            ],
        ]);
    }
}

?>