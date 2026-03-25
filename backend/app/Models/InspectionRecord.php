<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecord extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'inspection_records';

    // 主键
    protected $primaryKey = 'inspection_id';

    // 可批量赋值字段
    protected $fillable = [
        'order_id',
        'purchaser_id',
        'result',
        'inspection_time',
        'remarks',
    ];

    // 关闭自动更新 updated_at
    const UPDATED_AT = null;

    /**
     * 所属订单
     */
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'order_id');
    }

    /**
     * 执行抽检的采购商
     */
    public function purchaser()
    {
        return $this->belongsTo(User::class, 'purchaser_id', 'user_id');
    }
}
