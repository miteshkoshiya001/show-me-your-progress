<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'address1',
        'address2',
        'building_no',
        'landmark',
        'zipcode',
        'city_id',
        'state_id',
        'country_id',
        'type',
        'is_primary',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = request()->authUserId;
        });

        self::updating(function ($model) {
        });

        self::created(function ($model) {
        });

        self::updated(function ($model) {
        });
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function getUser(){
        return $this->hasOne(AppUser::class, 'id', 'user_id');
    }
}
