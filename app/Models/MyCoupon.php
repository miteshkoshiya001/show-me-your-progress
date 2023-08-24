<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyCoupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='my_coupons';
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'status',
        'expiry_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeSort($query){
        $query->orderBy('status', 'ASC');
    }
}
