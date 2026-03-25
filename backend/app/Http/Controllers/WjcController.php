namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInspectionRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Requests\StoreInspectionRequest;
use App\Models\Order;
use App\Models\Inspection;
use Illuminate\Http\Request;

class WjcController extends Controller
{
    //订单模拟方法

    //消费者创建订单

    public function storeOrder(StoreOrderRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        $totalAmount = collect($data['items'])->sum(function($item){
            return $item['quantity'] * 5.99;
        });

        $order = Order::create([
            'consumer_id' => $user->id,
            'total_amount' => $totalAmount,
            'shipping_address' => $data['shipping_address'],
            'status' =>'pending',
        ]);

        foreach($data['items'] as $item){
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => 5.99,
            ]);
        }

        return response()->json([
            'code' => 200,
            'msg' => '订单创建成功',
            'data' => [
                'order_id' => $order->id,
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
        $orders = Order::where('status', 'pending')->paginate(
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

    //采购商接单

    public function acceptOrder(Order $order)
    {
        $user = auth()->user();
        if ($order->status !== 'pending') {
            return response()->json(['code' => 400, 'message' => '订单状态不允许接单'], 400);
        }

        $order->update([
            'purchaser_id' => $user->id,
            'status' => 'accepted',
        ]);

        return response()->json([
            'code' => 200,
            'message' => '接单成功',
            'data' => null,
        ]);
    }

    //订单状态更新

    public function updateOrderStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        $order->update(['status' => $request->status]);

        return response()->json([
            'code' => 200,
            'message' => '订单状态更新成功',
            'data' => null,
        ]);
    }

    //查询订单详情

    public function showOrder(Order $order)
    {
        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'order_id' => $order->id,
                'consumer_id' => $order->consumer_id,
                'purchaser_id' => $order->purchaser_id,
                'total_amount' => $order->total_amount,
                'status' => $order->status,
                'shipping_address' => $order->shipping_address,
                'created_at' => $order->created_at->toDateTimeString(),
                'items' => $order->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name ?? '未知商品',
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                    ];
                }),
            ],
        ]);
    }

    // 抽检模块方法

    //提交抽检结果（采购商）

    public function storeInspection(StoreInspectionRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        $inspection = Inspection::create([
            'order_id' => $data['order_id'],
            'purchaser_id' => $user->id,
            'result' => $data['result'],
            'inspection_time' => $data['inspection_time'],
            'remarks' => $data['remarks'],
        ]);

        return response()->json([
            'code' => 200,
            'message' => '抽检结果提交成功',
            'data' => ['inspection_id' => $inspection->id],
        ]);
    }

    //查询采购商抽检记录

    public function purchaserInspectionList(Request $request)
    {
        $user = $request->user();
        $inspections = Inspection::where('purchaser_id', $user->id)->paginate(
            $request->input('size', 10),
            ['*'],
            'page',
            $request->input('page', 1)
        );

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'total' => $inspections->total(),
                'page' => $inspections->currentPage(),
                'size' => $inspections->perPage(),
                'list' => $inspections->map(function ($inspection) {
                    return [
                        'inspection_id' => $inspection->id,
                        'order_id' => $inspection->order_id,
                        'result' => $inspection->result,
                        'inspection_time' => $inspection->inspection_time,
                        'remarks' => $inspection->remarks,
                    ];
                }),
            ],
        ]);
    }

     //根据订单查询抽检结果

    public function showInspectionByOrder(Order $order)
    {
        $inspection = $order->inspection;

        if (!$inspection) {
            return response()->json(['code' => 404, 'message' => '该订单暂无抽检记录'], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'inspection_id' => $inspection->id,
                'order_id' => $inspection->order_id,
                'purchaser_id' => $inspection->purchaser_id,
                'result' => $inspection->result,
                'inspection_time' => $inspection->inspection_time,
                'remarks' => $inspection->remarks,
            ],
        ]);
    }
}