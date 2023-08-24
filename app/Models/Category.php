<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    protected $table = 'categories';
    protected $appends = ['image_url', 'parent_name'];
    public $translatedAttributes = ['name'];
    public $fillable = [
        'image',
        'status',
        'color',
        'parent_id',
        'is_important',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'parent_id',
        'image',
        'translations',
    ];
    
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
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
    public function scopeSort($query)
    {
        $query->orderBy('id', 'desc');
    }

    public function getImageUrlAttribute()
    {
        $id = $this->attributes['id'] ?? 0;
        if (!empty($id)) {
            return !empty($this->attributes['image']) && file_exists(base_path('public/storage/categories/' . $id . '/' . $this->attributes['image']))
                ? url('public/storage/categories/' . $id . '/' . $this->attributes['image'])
                : url('public/storage/categories/default-category.jpg');
        }
    }

    public function getParentNameAttribute()
    {
        $parentId = $this->attributes['parent_id'] ?? 0;
        if (!empty($parentId)) {
            $category = self::where([ 'id' => $parentId])->first();
            return !empty($category->name) ? $category->name : 'Inactive Category';
        }
        return false;
    }
}
