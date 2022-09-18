<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Country;
use App\Models\City;
use App\Models\State;

class DatabaseSeeder extends Seeder
{
public function run()
{
// User::factory(10)->create();
// Cart::factory()->count(5)->create();
//Catagory::factory()->count(5)->create();
$this->call(UserSeeder::class);
$this->call(RoleSeeder::class);
Catagory::factory()->count(10)->create();
Product::factory()->count(10)->create();
}
}
