<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table ='wishlists';
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopeSort($query){
        $query->orderBy('id', 'DESC');
    }

    public function scopeFullDetail($query){
        $query->with(['product']);
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id')->fullDetail();
    }
    
}
