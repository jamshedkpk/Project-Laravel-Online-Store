<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;

class CartFactory extends Factory
{
public function definition()
{
return 
[
'user_id'=>$this->faker->numberBetween(1,5),
'product_id'=>$this->faker->numberBetween(1,5),
'quantity'=>0,
'price'=>0,
'total'=>0
];
}
}
