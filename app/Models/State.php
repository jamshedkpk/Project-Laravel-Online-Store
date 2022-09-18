<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;

class State extends Model
{
use HasFactory;
protected $fillable=['name','iso2','country_code','latitude','longitude'];
// When choosing your own primary key difine the following three attributes
protected $primaryKey='iso2';
public $incrementing = false;
protected $keyType = 'string';

// Each country has many users
public function users()
{
return $this->hasMany(User::class);
}

// Each state belongs to a specific country
public function country()
{
return $this->belongsTo(Country::class);
}

// Each state has many cities
public function cities()
{
return $this->hasMany(City::class);
}
}
