<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'phone',
        'email',
        'role',
        'real_name',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * 获取 JWT 标识符
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 获取 JWT 自定义声明
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 关联商品（作为供应商）
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }

    /**
     * 关联订单（作为消费者）
     */
    public function consumerOrders()
    {
        return $this->hasMany(Order::class, 'consumer_id', 'id');
    }

    /**
     * 关联订单（作为采购商）
     */
    public function purchaserOrders()
    {
        return $this->hasMany(Order::class, 'purchaser_id', 'id');
    }

    /**
     * 关联抽检记录
     */
    public function inspectionRecords()
    {
        return $this->hasMany(InspectionRecord::class, 'purchaser_id', 'id');
    }
}
