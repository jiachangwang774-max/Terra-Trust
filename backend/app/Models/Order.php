<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = [
        'consumer_id',
        'purchaser_id',
        'total_amount',
        'status',
        'shipping_address'
    ];

    //关联订单项
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    //关联消费者
    public function consumer()
    {
        return $this->belongsTo(User::class,'consumer_id');
    }

    //关联采购商
    public function purchaser()
    {
        return $this->belongsTo(User::class,'purchaser_id');
    }

    //关联抽检记录
    public function inspection()
    {
        return $this->hasOne(InspectionRecord::class);
    }
}
