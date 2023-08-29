<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class StickerCollection extends model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    protected $table = 'sticker_collections';

    public $translatedAttributes = ['name'];
    public $fillable = [
        'sticker_category_id',
        'is_premium',
        'is_default',
        'status',
    ];

    protected $with = ['category'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'translations',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // Add any logic you need before creating the model
        });

        self::updating(function ($model) {
            // Add any logic you need before updating the model
        });

        self::created(function ($model) {
            // Add any logic you need after creating the model
        });

        self::updated(function ($model) {
            // Add any logic you need after updating the model
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->hasOne(StickerCategory::class, 'id', 'sticker_category_id'); // One-to-one relationship
    }
}
