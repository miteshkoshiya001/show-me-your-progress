<?php

namespace App\Models;

use App\Helpers\Helper;
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
        'name',
        'phone',
        'email',
        'status',
        'api_token',
        'avatar',
        'password',
        'language',
        'user_type',
        'plain_pass'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'api_token',
        'password',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->api_token = Str::random(80);
            $model->plain_pass = $model->password;
            $model->password = Hash::make($model->password);
        });

        self::updating(function ($model) {
        });

        self::created(function ($model) {
        });

        self::updated(function ($model) {
        });
    }

    public function scopeSort($query)
    {
        $query->orderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
    public static function loginUser()
    {
        $user = self::where(['phone' => request()->phone])->firstOrFail();
        if ($user && Hash::check(request()->password, $user->password)) {
            return $user;
        }
        return null;
    }

    public function getAvatarUrlAttribute()
    {
        $id = $this->attributes['id'];
        if (!empty($id)) {
            return !empty($this->attributes['avatar']) && file_exists(base_path('public/storage/user/' . $id . '/' . $this->attributes['avatar']))
                ? url('public/storage/user/' . $id . '/' . $this->attributes['avatar'])
                : url('public/storage/user/default.png');
        }
    }
}
