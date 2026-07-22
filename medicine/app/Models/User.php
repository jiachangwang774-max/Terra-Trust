<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'phone', 'email', 'real_name',
        'gender', 'age', 'avatar', 'status', 'last_login_time',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'gender' => 'integer',
        'age' => 'integer',
        'status' => 'integer',
        'last_login_time' => 'datetime',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public function relatives()
    {
        return $this->belongsToMany(
            Relative::class,
            'user_relatives',
            'user_id',
            'relative_id'
        )->withPivot(['relation_text', 'permission', 'bind_status', 'bind_time']);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'user_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'user_id');
    }

    public function medicationRecords()
    {
        return $this->hasMany(MedicationRecord::class, 'user_id');
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'user_id');
    }

    public function notices()
    {
        return $this->hasMany(Notice::class, 'user_id');
    }
}
