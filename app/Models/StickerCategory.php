<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class StickerCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    protected $table = 'sticker_categories'; // Adjust the table name

    public $translatedAttributes = ['name'];
    public $fillable = [
        'status',
    ];

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

    // Add any additional relationships and methods as needed
}
