<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

use App;

class FrontEndController extends Controller
{
public function index()
{
if(Auth::id()==1)
{
return redirect()->route('dashboard');
}
else
{
// Show all catagories and products which are available in random order and paginate
$products=Product::where(['status'=>1])->inRandomOrder()->paginate(8);
$catagories=Catagory::where(['status'=>1])->limit(10)->get();
// Sending catagories and products to the main page of user
return view('layouts.frontend.product')->with(['products'=>$products,'catagories'=>$catagories]);
}
}

public function searchCatagoryProduct($id)
{
$catagories=Catagory::where(['status'=>1])->limit(10)->get();
$products=Product::where(['catagory_id'=>$id,'status'=>1])->inRandomOrder()->paginate(8);
return view('layouts.frontend.catagory')->with(['catagories'=>$catagories,'products'=>$products]);    
}

public function productDetail($id)
{
// Get product detail 
$product=Product::find($id);
$stars=5;
$rating=Rating::where(['product_id'=>$id,'user_id'=>Auth::id()])->pluck('star_rating')->first();
$rate_value=$rating/$stars;
return view('layouts.frontend.product_detail')->with(['product'=>$product,'stars'=>$stars,'rating'=>$rating,'rate_value'=>$rate_value]);
}

// change language
public function changeLanguage(Request $request)
{
$language=$request->lang;
App::setLocale($language);
session()->put("locale",$language);
return response()->json(['data'=>'Language is successfully changed']);
}

// complete auto search through ajax
public function searchAutoComplete()
{
$products=Product::select('name')->where(['status'=>1])->get();
$data=[];
foreach($products as $item)
{
$data[]=$item['name'];
}
return $data;    
}

// search products through search bar
public function searchProduct(Request $request)
{
$search=$request->search;
if($search!=null)
{
$product=Product::where("name","LIKE","%$search%")->first();
if($product)
{
return redirect()->route('product-detail',$product->id);
}
}
else
{
return back()->with(['search-error'=>'Please Enter A Product Name To Search !']);
}
}
}
