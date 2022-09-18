<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;

class City extends Model
{
use HasFactory;
protected $fillable=['name'];

// When choosing your own primary key difine the following three attributes
protected $primaryKey='iso2';
public $incrementing = false;
protected $keyType = 'string';

// Each country has many users
public function users()
{
return $this->hasMany(User::class);
}

public function country()
{
return $this->belongsTo(Country::class);
}

public function state()
{
return $this->belongsTo(State::class);
}

}
