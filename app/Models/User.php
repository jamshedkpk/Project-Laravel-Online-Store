<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Country;
use App\Models\User;
use App\Models\State;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'address_id',
        'mobile',
        'photo',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Each role can be associated to many users
public function role()
{
return $this->belongsTo(Role::class);
}

// Return role of user wheither it is a admin or user
public function checkRole()
{
    $userid=Auth::id(); 
    $role=User::join('roles','roles.id','=','users.role_id')
    ->where('users.id','=',$userid)
    ->first();
    return $role->name;
}
// Each user has many products to buy
public function productwishlist()
{
return $this->belongsToMany(Product::class,'wishlists','user_id','product_id');
}
// Each user has many products to buy
public function products()
{
return $this->belongsToMany(Product::class,'carts','user_id','product_id');
}
// Each user belongs to a country
public function country()
{
return $this->belongsTo(Country::class);
}

// Each user belongs to a city
public function city()
{
return $this->belongsTo(City::class);
}
// Each user belongs to a state
public function state()
{
return $this->belongsTo(State::class);
}
}
