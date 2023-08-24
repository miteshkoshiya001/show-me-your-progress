<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrendingOffer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'trending_offers';
    protected $appends = ['banner_url'];
    protected $fillable = [
        'title',
        'banner',
        'category_id',
        'is_pop_up',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
    ];
    

    public function scopeActive($query){
        $query->where('status', 1);
    }

    public function scopeIsPopUp($query){
        $query->where('is_pop_up', 1);
    }

    public function getBannerUrlAttribute(){
        $id = $this->attributes['id'] ?? 0;
        if (!empty($id)) {
            return !empty($this->attributes['banner']) && file_exists(base_path('public/storage/trending-offers/' . $id . '/' . $this->attributes['banner']))
                ? url('public/storage/trending-offers/' . $id . '/' . $this->attributes['banner'])
                : url('public/storage/trending-offers/default-trending-offers.jpg');
        }
    }


}
