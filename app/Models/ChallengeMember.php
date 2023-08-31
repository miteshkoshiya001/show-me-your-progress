<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeMember extends Model
{
    use HasFactory;
    protected $table = 'challenge_members';
    protected $fillable = [
        'challenge_id',
        'member_id',
    ];

}
