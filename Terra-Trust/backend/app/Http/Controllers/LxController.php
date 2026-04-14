<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LxController extends \Illuminate\Routing\Controller
{
    /**
     * 用户注册
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|string|in:consumer,supplier,purchaser',
            'real_name' => 'nullable|string|max:255',
            'address' => 'required|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'code' => 200,
            'message' => '注册成功',
            'data' => $user,
        ]);
    }

    /**
     * 用户登录
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $validated['username'],
            'password' => $validated['password'],
        ];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'code' => 401,
                    'message' => '用户名或密码错误',
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'code' => 500,
                'message' => '无法创建令牌',
            ], 500);
        }

        $user = JWTAuth::user();

        return response()->json([
            'code' => 200,
            'message' => '登录成功',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
            ],
        ]);
    }

    /**
     * 重置密码
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        if (!Hash::check($validated['old_password'], $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => '原密码错误',
            ], 400);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'code' => 200,
            'message' => '密码重置成功',
        ]);
    }

    /**
     * 获取个人信息
     */
    public function profile(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => $user,
        ]);
    }

    /**
     * 修改个人信息
     */
    public function updateProfile(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'real_name' => 'nullable|string|max:255',
             'username' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        // 过滤掉 null 值，只保留实际要修改的字段
        $updateData = array_filter($validated, function ($value) {
            return $value !== null && $value !== '';
        });

        if (empty($updateData)) {
            return response()->json([
                'code' => 400,
                'message' => '请提供要修改的字段',
            ], 400);
        }

        $user->update($updateData);

        // 返回修改后的用户信息
        return response()->json([
            'code' => 200,
            'message' => '修改成功',
            'data' => $user->fresh(),
        ]);
    }

    /**
     * 注销账号
     */
    public function deleteAccount(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validated = $request->validate([
            'password' => 'required|string',
        ]);

        // 验证密码
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => '密码错误',
            ], 400);
        }

        // 删除用户
        $user->delete();

        // 使当前 token 失效
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'code' => 200,
            'message' => '账号注销成功',
        ]);
    }

    /**
     * 发布商品（供应商）
     */
    public function storeProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        // 检查是否为供应商
        if ($user->role !== 'supplier') {
            return response()->json([
                'code' => 403,
                'message' => '只有供应商可以发布商品',
            ], 403);
        }

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'category' => 'nullable|string|max:100',
        ]);

        // 检查该供应商是否已发布过同名商品
        $existingProduct = Product::where('supplier_id', $user->id)
            ->where('product_name', $validated['product_name'])
            ->first();

        if ($existingProduct) {
            return response()->json([
                'code' => 400,
                'message' => '您已发布过同名商品，请勿重复发布',
            ], 400);
        }

        $validated['supplier_id'] = $user->id;

        $product = Product::create($validated);

        return response()->json([
            'code' => 200,
            'message' => '商品发布成功',
            'data' => $product,
        ]);
    }

    /**
     * 修改商品信息（供应商）
     */
    public function updateProduct(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'supplier') {
            return response()->json([
                'code' => 403,
                'message' => '只有供应商可以修改商品',
            ], 403);
        }

        $product = Product::where('id', $id)
            ->where('supplier_id', $user->id)
            ->first();

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => '商品不存在或无权限修改',
            ], 404);
        }

        $validated = $request->validate([
            'product_name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'unit' => 'sometimes|string|max:50',
            'category' => 'nullable|string|max:100',
        ]);

        $product->update($validated);

        return response()->json([
            'code' => 200,
            'message' => '商品信息修改成功',
            'data' => $product,
        ]);
    }

    /**
     * 修改库存（供应商）
     */
    public function updateStock(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'supplier') {
            return response()->json([
                'code' => 403,
                'message' => '只有供应商可以修改库存',
            ], 403);
        }

        $product = Product::where('id', $id)
            ->where('supplier_id', $user->id)
            ->first();

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => '商品不存在或无权限修改',
            ], 404);
        }

        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return response()->json([
            'code' => 200,
            'message' => '库存修改成功',
            'data' => $product,
        ]);
    }

    /**
     * 删除商品（供应商）
     */
    public function deleteProduct($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'supplier') {
            return response()->json([
                'code' => 403,
                'message' => '只有供应商可以删除商品',
            ], 403);
        }

        $product = Product::where('id', $id)
            ->where('supplier_id', $user->id)
            ->first();

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => '商品不存在或无权限删除',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'code' => 200,
            'message' => '商品删除成功',
        ]);
    }

    /**
     * 查询商品列表
     */
    public function productList(Request $request)
    {
        $query = Product::query();

        // 可选筛选条件
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('keyword')) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 分页
        $products = $query->with('supplier:id,username,real_name')
            ->paginate($request->per_page ?? 10);

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => $products,
        ]);
    }

    /**
     * 查询商品详情
     */
    public function productDetail($id)
    {
        $product = Product::with('supplier:id,username,real_name,phone,email')
            ->find($id);

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => '商品不存在',
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => $product,
        ]);
    }
}
