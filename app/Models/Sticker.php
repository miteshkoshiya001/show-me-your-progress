<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_type',
        'sticker_template',
        'template_x',
        'template_y',
        'template_width',
        'template_height',
    ];

    // public function driver()
    // {
    //     return $this->belongsTo(Driver::class);
    // }
}
