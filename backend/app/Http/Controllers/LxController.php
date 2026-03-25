<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
            'phone' => 'nullable|string|max:20|unique:users',
            'email' => 'nullable|email|max:255|unique:users',
            'role' => 'required|string|in:consumer,supplier,purchaser',
            'real_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'code' => 200,
            'message' => '注册成功',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
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

        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['用户名或密码错误'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'code' => 200,
            'message' => '登录成功',
            'data' => [
                'user' => $user,
                'token' => $token,
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

        /** @var User $user */
        $user = Auth::user();

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
        /** @var User $user */
        $user = Auth::user();

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
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'real_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $user->update($validated);

        return response()->json([
            'code' => 200,
            'message' => '修改成功',
            'data' => $user,
        ]);
    }
}
