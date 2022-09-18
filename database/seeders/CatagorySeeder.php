<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catagory;

class CatagorySeeder extends Seeder
{
public function run()
{
Catagory::create
([
'name'=>'Electronics',
'slug'=>'Electronics',
'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum, hic nemo sed quo minima laboriosam cupiditate excepturi accusantium quaerat sunt facere tenetur dolor ipsa. Voluptas explicabo nostrum iure magnam?',
'meta_title'=>'Here is catagory meta title',
'meta_keyword'=>'Here is catagory meta keyword',
'meta_description'=>'Here is catagory meta description',
'status'=>random_int(0,1),
'popular'=>random_int(0,1),
'photo'=>'Image is here',
]);
Catagory::create
([
'name'=>'Garments',
'slug'=>'Garments',
'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum, hic nemo sed quo minima laboriosam cupiditate excepturi accusantium quaerat sunt facere tenetur dolor ipsa. Voluptas explicabo nostrum iure magnam?',
'meta_title'=>'Here is catagory meta title',
'meta_keyword'=>'Here is catagory meta keyword',
'meta_description'=>'Here is catagory meta description',
'status'=>random_int(0,1),
'popular'=>random_int(0,1),
'photo'=>'Image is here',
]);
Catagory::create
([
'name'=>'Crockery',
'slug'=>'Crockery',
'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum, hic nemo sed quo minima laboriosam cupiditate excepturi accusantium quaerat sunt facere tenetur dolor ipsa. Voluptas explicabo nostrum iure magnam?',
'meta_title'=>'Here is catagory meta title',
'meta_keyword'=>'Here is catagory meta keyword',
'meta_description'=>'Here is catagory meta description',
'status'=>random_int(0,1),
'popular'=>random_int(0,1),
'photo'=>'Image is here',
]);
Catagory::create
([
'name'=>'Men Fashion',
'slug'=>'Men Fashion',
'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum, hic nemo sed quo minima laboriosam cupiditate excepturi accusantium quaerat sunt facere tenetur dolor ipsa. Voluptas explicabo nostrum iure magnam?',
'meta_title'=>'Here is catagory meta title',
'meta_keyword'=>'Here is catagory meta keyword',
'meta_description'=>'Here is catagory meta description',
'status'=>random_int(0,1),
'popular'=>random_int(0,1),
'photo'=>'Image is here',
]);
Catagory::create
([
'name'=>'Lady Fashion',
'slug'=>'Lady Fashion',
'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde illum, hic nemo sed quo minima laboriosam cupiditate excepturi accusantium quaerat sunt facere tenetur dolor ipsa. Voluptas explicabo nostrum iure magnam?',
'meta_title'=>'Here is catagory meta title',
'meta_keyword'=>'Here is catagory meta keyword',
'meta_description'=>'Here is catagory meta description',
'status'=>random_int(0,1),
'popular'=>random_int(0,1),
'photo'=>'Image is here',
]);


}  
}
