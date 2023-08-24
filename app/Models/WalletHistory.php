<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wallet_histories';
    protected $appends = ['date'];
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'order_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
    ];

    public function scopeSort($query){
        $query->orderBy('id','DESC');
    }

    public function scopeDetails($query){
        $query->with(['order']);
    }

    public function order(){
        return $this->hasOne(Order::class, 'id', 'order_id')->select(['id', 'order_id']);
    }

    public function getDateAttribute(){
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
}
