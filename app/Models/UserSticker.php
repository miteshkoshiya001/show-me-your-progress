<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSticker extends Model
{
    use HasFactory;
    protected $table = 'users_sticker'; // Adjust table name if needed

    protected $fillable = [
        'driver_id',
        'user_id',
        'stk_path_1',
        'stk_path_2',
        'stk_path_3',
        'stk_path_4',
        'stk_path_5',
        'stk_path_6',
    ];
}
