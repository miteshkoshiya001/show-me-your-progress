<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UOM extends Model
{
    use HasFactory;
    protected $table = 'u_o_m_s';
    protected $fillable =
    [
        'title',
        'symbol',
    ];

    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
