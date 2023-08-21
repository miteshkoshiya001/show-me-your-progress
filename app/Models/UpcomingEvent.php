<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'event_date',
        'location',
    ];


}
