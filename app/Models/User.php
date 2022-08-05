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
 * @property string $password
 * @property bool $is_merchant
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'phone', 'image', 'is_merchant','password'];
    protected $appends = ['image_url'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token','created_at', 'updated_at','email_verified_at'];
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

}
