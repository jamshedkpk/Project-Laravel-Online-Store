<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
public function definition()
{
$originalPrice=$this->faker->numberBetween(5000,10000);
$name=$this->faker->text(15);
return 
[
'catagory_id'=>$this->faker->numberBetween(1,5),
'name'=>$name,
'description'=>$this->faker->text(300),
'original_price'=>$originalPrice,
'selling_price'=>($originalPrice-500),
'photo'=>$this->faker->imageUrl($height=200,$width=200),
'quantity'=>$this->faker->numberBetween(10,50),
'slug'=>$name,
'status'=>random_int(0,1),
];
}
}
