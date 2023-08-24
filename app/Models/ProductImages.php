<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $appends = ['image_url'];

    public $fillable = [
        'product_id',
        'image',
        'is_primary',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getImageUrlAttribute()
    {
        if (isset($this->attributes['image'])) {
            return !empty($this->attributes['image']) && file_exists(base_path('public/storage/products/' . $this->attributes['product_id'] . '/' . $this->attributes['image']))
                ? url('public/storage/products/' . $this->attributes['product_id'] . '/' . $this->attributes['image'])
                : url('public/storage/products/default-category.jpg');
        }
        return url('public/storage/products/default-category.jpg');
    }
    
}
