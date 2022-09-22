<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catagory;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    protected $fillable=
    [
    'catagory_id','name','slug','description','original_price','selling_price',
    'photo','quantity','status'
    ];

// Each product belongs to a specific catagory
public function catagory()
{
return $this->belongsTo(Catagory::class);
}
// Each product can be buyed by multiple users
public function users()
{
return $this->belongsToMany(User::class,'carts','product_id','user_id');
}

// Each product can be wished by multiple users
public function userwishlist()
{
return $this->belongsToMany(User::class,'wishlists','product_id','user_id');
}
// Each product has multiple user rates
public function userRates()
{
return $this->hasMany(User::class);
}
}
