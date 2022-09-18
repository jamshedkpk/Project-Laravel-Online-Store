<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\State;
use App\App\City;

class Country extends Model
{
use HasFactory;
protected $fillable=['name','iso2'];
// When choosing your own primary key difine the following three attributes
protected $primaryKey='iso2';
public $incrementing = false;
protected $keyType = 'string';

// Each country has many users
public function users()
{
return $this->hasMany(User::class);
}
// Each country has many states
public function states()
{
return $this->hasMany(State::class);
}

// Each country has many cities
public function cities()
{
return $this->hasMany(City::class);
}

}
