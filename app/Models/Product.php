<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;
    protected $table = 'products';
    public $translatedAttributes = ['title', 'description'];
    public $appends = ['sold'];
    public $fillable = [
        'category_id',
        'uom_id',
        'sku',
        'stock',
        'price',
        'fake_price',
        'user_discount',
        'status',
        'actual_price',
        'unit_number',
        'sorting',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'translations',
        'category_id',
        'uom_id',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->sku = Helper::randomAlphabetNumberGenerate();
        });

        self::updating(function ($model) {
        });

        self::created(function ($model) {
        });

        self::updated(function ($model) {
        });
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class, 'product_id', 'id')->where('user_id', request()->authUserId);
    }

    public function unit()
    {
        return $this->hasOne(UOM::class, 'id', 'uom_id');
    }

    public function scopeFullDetail($query)
    {
        return $query->with(['images', 'category', 'unit', 'wishlist']);
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSort($query)
    {
        $query->orderBy('id', 'DESC');
    }

    public function getSoldAttribute()
    {
        if (isset($this->attributes['id']) && !empty($this->attributes['id'])) {
            return OrderItem::where('product_id', $this->attributes['id'])->whereNot('status', config('constants.order_status.cancelled.value'))->sum('quantity');
        }
        return 0;
    }

    /* public function getPriceAttribute()
    {
        return $this->attributes['price'] * $this->attributes['unit_number'];
    } */
}
