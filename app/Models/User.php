<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\Listing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia; 
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'provider',
        'provider_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function profile() 
    {
        return $this->hasOne(UserDetail::class);
    }
    public function exprience() 
    {
        return $this->hasOne(UserExprience::class);
    }
    public function company() 
    {
        return $this->hasOne(UserCompany::class);
    }
    public function paymentDetail() 
    {
        return $this->hasOne(UserPaymentDetail::class);
    }
    public function listing()
    {
        return $this->hasMany(Listing::class);
    }
    public function listingOrders()
    {
        return $this->hasManyThrough(Order::class, Listing::class);
    }
    public function favoriteitems() 
    {
        return $this->hasMany(FavoriteItem::class);
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'receiver_id');
    }
    public function listings()
    {
        return $this->hasManyThrough(Listing::class, Message::class, 'sender_id', 'id', 'id', 'listing_id')->distinct();
    }
    
}
