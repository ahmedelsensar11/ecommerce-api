<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;


/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $image
 * @property string $cover
 * @property string $gender
 * @property integer $otp
 * @property bool $is_admin
 * @property bool $subscribed
 * @property string $fcm_token
 * @property string $location
 * @property string $birth_date
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'phone', 'cover','image', 'subscribed', 'is_admin', 'gender', 'location', 'password', 'birth_date','otp'];
    protected $appends = ['image_url','cover_url'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token','created_at', 'updated_at'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ['email_verified_at' => 'datetime',];


    public function getImageUrlAttribute(): string
    {
        if ($this->image != ''){
            return url(Storage::url($this->image));
        }
        return url(Storage::url('users/avatar/default.png'));
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->cover != ''){
            return url(Storage::url($this->cover));
        }
        return url(Storage::url('default/users/cover.png'));
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function supportMessages()
    {
        return $this->hasMany('App\Models\Support','user_id','id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','owner_id','id');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\ProductOrder','user_id','id');
    }

    public function providerRatings()
    {
        return $this->hasMany('App\Models\Rating','provider_id','id');
    }

    public function userRatings()
    {
        return $this->hasMany('App\Models\Rating','user_id','id');
    }

    public function favourites()
    {
        return $this->hasMany('App\Models\Favorite','user_id','id');
    }

    public function favouriteProducts()
    {
        return $this->belongsToMany('App\Models\Product', 'favorites', 'user_id', 'product_id');
    }
}
