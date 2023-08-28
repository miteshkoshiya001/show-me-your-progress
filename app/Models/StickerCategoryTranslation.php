<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StickerCategoryTranslation extends Model
{
    use SoftDeletes;

    protected $table = 'sticker_category_translations';

    protected $fillable = [
        'sticker_category_id', // Change this to match the relationship
        'locale',
        'name',
    ];
}

