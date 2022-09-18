<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Support\Facades\Auth;
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

public function productDetail($pslug,$id)
{
// Get product detail 
$product=Product::find($id);
return view('layouts.frontend.product_detail')->with(['product'=>$product]);
}

// change language
public function changeLanguage(Request $request)
{
$language=$request->lang;
App::setLocale($language);
session()->put("locale",$language);
return response()->json(['data'=>'Language is successfully changed']);
}
}
