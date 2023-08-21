<?php

namespace App\Models;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RaceType extends Model
{
    use HasFactory;
    protected $fillable = ['race_name'];


    public function drivers()
    {
        return $this->hasMany(Driver::class, 'race_type_id');
    }
}
