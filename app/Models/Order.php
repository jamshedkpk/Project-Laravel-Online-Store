<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
use HasFactory;
protected $fillable=
[
'user_id',
'token',
'date',
'status',
'total',
'type'
];

public function orderitems()
{
return $this->hasMany(OrderItem::class);
}
}
