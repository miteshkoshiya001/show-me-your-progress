<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'order_numer',
        'product_id',
        'quantity',
        'unit_id',
        'price',
        'item_total',
        'status',
    ];

    protected $hidden = [
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
        
    public function unit()
    {
        return $this->hasOne(UOM::class, 'id', 'unit_id');
    }
        
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->fullDetail();
    }
    public function scopeFullDetail($query)
    {
        return $query->with(['unit', 'product']);
    }
}
