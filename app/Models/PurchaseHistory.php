<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'purchase_histories';
    protected $fillable = [
        'product_id',
        'stock',
        'description',
        'price',
    ];
    
    public function scopeSort($query){
        $query->orderBy('id', 'DESC');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
