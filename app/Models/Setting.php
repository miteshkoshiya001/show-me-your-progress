<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'settings';
    protected $fillable = [
        'min_item_count',
        'min_order_amount',
        'coupon_expiry_time',
        'privacy_policy_url',
        'terms_and_conditions',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'min_item_count',
        'min_order_amount',
        'coupon_expiry_time',
    ];

    public function getTermsAndConditionsAttribute(){
        return strip_tags($this->attributes['terms_and_conditions']);
    }
}
