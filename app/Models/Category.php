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

    protected $table = 'user_categories';

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



}
