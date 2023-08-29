<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChallangeTranslate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'challange_translates';
    protected $fillable = [
        'challenge_id',
        'locale',
        'title',
        'description'
    ];
}
