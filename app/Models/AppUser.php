<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'app_users';

    protected $appends = ['avatar_url'];

    protected $fillable = [
        'avatar',
        'email',
        'first_name',
        'last_name',
        'username',
        'phone',
        'user_category_id',
        'referral_code',
        'password',
        'status',
        'api_token',
        'parent_id',
        'language',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'api_token',
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // Generate a unique API token for the user
            $model->api_token = Str::random(80);

            // Hash the password
            $model->password = Hash::make($model->password);

            // Generate a referral code if not provided

                $model->referral_code = strtoupper(Str::random(6));


            // Set parent_id based on referral code
            if (!$model->parent_id && $model->referral_code) {
                $parentUser = self::where('referral_code', $model->referral_code)->first();
                if ($parentUser) {
                    $model->parent_id = $parentUser->id;
                }
            }
        });
    }

    // Other methods and scopes remain unchanged

    public function getAvatarUrlAttribute()
    {
        $id = $this->attributes['id'];
        if (!empty($id)) {
            return !empty($this->attributes['avatar']) && file_exists(storage_path('app/public/user/' . $id . '/' . $this->attributes['avatar']))
                ? asset('storage/user/' . $id . '/' . $this->attributes['avatar'])
                : asset('storage/user/default.png');
        }
    }

    public static function loginUser()
    {
        $user = self::where(['username' => request()->username])->firstOrFail();
        if ($user && Hash::check(request()->password, $user->password)) {
            return $user;
        }
        return null;
    }
}
