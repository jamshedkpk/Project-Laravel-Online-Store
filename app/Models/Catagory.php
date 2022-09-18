<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Catagory extends Model
{
    use HasFactory;
    protected $fillable=
    [
    'name','slug','description','meta_title','meta_keyword','meta_description',
    'status','popular','photo'
    ];

// One catagory has many products
public function products()
{
return $this->hasMany(Product::class);
}
}
