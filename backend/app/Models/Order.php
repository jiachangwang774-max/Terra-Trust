<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'consumer_id',
        'purchaser_id',
        'total_amount',
        'status',
        'shipping_address'
    ];

    /**
     * 关联订单项
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * 关联消费者
     */
    public function consumer()
    {
        return $this->belongsTo(User::class, 'consumer_id', 'id');
    }

    /**
     * 关联采购商
     */
    public function purchaser()
    {
        return $this->belongsTo(User::class, 'purchaser_id', 'id');
    }

    /**
     * 关联抽检记录
     */
    public function inspection()
    {
        return $this->hasOne(InspectionRecord::class, 'order_id', 'id');
    }
}
