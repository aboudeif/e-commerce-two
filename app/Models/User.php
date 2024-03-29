<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Favourite;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProcess;
use App\Models\ShippingAddress;
use App\Models\UserAction;
use App\Models\UserReport;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function favourites(){
        return $this->hasMany(Favourite::class,'user_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class,'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

    public function shippingAddresses(){
        return $this->hasMany(ShippingAddress::class,'user_id');
    }

    public function orderProcesses(){
        return $this->hasMany(OrderProcess::class,'user_id');
    }

    public function userAction()
    {
        return $this->hasMany(UserAction::class,'user_id');
    }

    // public function getProfilePhotoUrlAttribute()
    // {
    //     return $this->getFirstMediaUrl('profile_photo');
    // }

    public function userReports(){
        return $this->hasMany(UserReport::class,'user_id');
    }

    // // user profile photo
    // public function getProfilePhotoUrlAttribute()
    // {
    //     $photo = isset($this->profile_photo) ? $this->profile_photo : 'https://via.placeholder.com/150';
    //    // $photo = $this->getFirstMedia('profile_photo');
    //     if ($photo) {
    //         return $photo;
    //     }
    //     return asset('images/default-user.png');
    // }

}
