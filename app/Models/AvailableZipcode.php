<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvailableZipcode extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['zipcode'];
    protected $table = 'available_zipcodes';
    protected $fillable = [
        'zipcodes'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'zipcodes',
    ];

    public function getZipcodeAttribute(){
        $zipcodes = $this->attributes['zipcodes'];
        if(!empty($zipcodes)){
            $zipcode = explode(':', $zipcodes);
            $zipcodeInArray = in_array(request()->get('zipcode'), $zipcode);
            if($zipcodeInArray == true){
                return request()->get('zipcode');
            }
            return false;
            $educationIds = explode(',', $this->attributes['education_tag_id']);
        }
    }
}
