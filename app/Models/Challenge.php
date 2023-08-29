<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challenge  extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    protected $table = 'challenges';
    protected $translationModel = 'App\Models\ChallangeTranslate';

    public $translatedAttributes = ['title', 'description'];
    protected $appends = ['image_url'];

    public $fillable = [
        'video_link',
        'image',
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
    public function getImageUrlAttribute()
    {
        $id = $this->attributes['id'];
        if (!empty($id)) {
            return !empty($this->attributes['image']) && file_exists(storage_path('app/public/challenges/' . $this->attributes['image']))
                ? asset('storage/challenges/'. $this->attributes['image'])
                : null;
        }
    }
}
