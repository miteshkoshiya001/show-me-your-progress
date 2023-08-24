<?php

namespace App\Models;

use Carbon\Carbon;
use App\Helpers\Helper;
use App\Models\AppUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $appends = ['status_label'];
    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',
        'order_total',
        'order_wallet_amount',
        'order_date',
        'order_note',
        'status',
        'order_otp',
        'assigned_id',
        'cancel_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = request()->authUserId;
            $model->order_wallet_amount = request()->use_wallet_amount;
            $model->order_id = Helper::randomAlphabetNumberGenerate('ORD-');
            $model->order_date =  Carbon::now()->format('Y-m-d H:i:s');
        });

        self::updating(function ($model) {
        });

        self::created(function ($model) {
        });

        self::updated(function ($model) {
        });
    }

    public function scopeSort($query)
    {
        $query->orderBy('id', 'DESC');
    }

    public function scopeFullDetail($query)
    {
        return $query->with(['orderItems', 'user', 'deliveryAddress', 'assigned']);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->fullDetail();
    }

    public function user()
    {
        return $this->hasOne(AppUser::class, 'id', 'user_id');
    }
    
    public function assigned()
    {
        return $this->hasOne(AppUser::class, 'id', 'assigned_id');
    }

    public function deliveryAddress()
    {
        return $this->hasOne(DeliveryAddress::class, 'id', 'address_id');
        return $this->hasOne(DeliveryAddress::class, 'user_id', 'user_id');
    }
    public function getStatusLabelAttribute()
    {
        if(!isset($this->attributes['status'])){
            return "";
        }
        $status = $this->attributes['status'];
        if ($status == 1) {
            $label = 'In progress';
        } elseif ($status == 2) {
            $label = 'Confirmed';
        } elseif ($status == 3) {
            $label = 'Shipped';
        } elseif ($status == 4) {
            $label = 'Delivered';
        } elseif ($status == 5) {
            $label = 'Cancelled';
        } else {
            $label = 'Pending';
        }
        return $label;
    }
}
