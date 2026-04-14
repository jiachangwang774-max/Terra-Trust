<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'order_items';

    // 主键
    protected $primaryKey = 'order_item_id';

    // 可批量赋值字段
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    // 关闭自动维护时间戳（表中无 created_at / updated_at）
    public $timestamps = false;

    /**
     * 所属订单
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * 所属商品
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
