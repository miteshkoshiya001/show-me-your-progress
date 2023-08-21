<?php

namespace App\Models;

use App\Models\RaceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'race_type_id'];
    public function race()
    {
        return $this->belongsTo(RaceType::class, 'race_type_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
