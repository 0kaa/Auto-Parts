<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email', 'phone', 'image', 'lat', 'lng', 'address', 'verification_code', 'approved', 'email_verified_at', 'name_company', 'name_owner_company', 'national_identity', 'date', 'file', 'ibn',
        'city_id', 'is_company_facility_agent', 'is_company_facility_authorized_distributor', 'other_branches', 'activity_type_id', 'commercial_register_id', 'region_id', 'company_sector_id',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function name() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function branches()
    {
        return $this->hasMany(BranchesCompanyUser::class);
    }

    public function firebase_tokens()
    {
        return $this->hasMany(DeviceToken::class, 'user_id');
    }

    public function company_sector()
    {
        return $this->belongsTo(CompanySector::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id', 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id', 'id');
    }

    public function user_orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function user_custom_orders()
    {
        return $this->hasMany(CustomOrder::class, 'user_id', 'id');
    }

    public function store_orders()
    {
        return $this->hasMany(Order::class, 'seller_id', 'id');
    }

    public function store_custom_orders()
    {
        return $this->hasMany(MultiCustomOrder::class, 'seller_id', 'id');
    }

    public function activity_name()
    {
        return $this->hasOne(ActivityType::class, 'id', 'activity_type_id');
    }

    public function activities()
    {
        return $this->hasMany(UserActivities::class, 'user_id', 'id');
    }

    public function region_name()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function city_name()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'favouriteable');
    }

    public function user_favourites()
    {
        return $this->hasMany(Favourite::class, 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function devices()
    {
        return $this->hasMany(DeviceToken::class, 'user_id', 'id');
    }

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function multi_custom_orders()
    {
        return $this->hasOne(MultiCustomOrder::class);
    }
    public function isFav()
    {
        return $this->favourite()->where('user_id', auth()->id())->exists();
    }
}
