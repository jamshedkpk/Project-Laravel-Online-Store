<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
public function index()
{
// To check user is login or not
if(Auth::check())
{
// Get user id from Auth class
$userid=Auth::id();
// Select the product from cart table which is added by user
$products=Cart::join('products','carts.product_id','=','products.id')
->join('users','carts.user_id','=','users.id')
->where('carts.user_id','=', $userid)
->get(['products.id','products.name','products.photo','products.selling_price','carts.quantity']);
return view('layouts.frontend.cart')->with(['products'=>$products]);    
}
// If user is not log in than redirect to login page
else
{
return redirect()->route('login');
}
}

// Add product to cart
public function addProductToCart(Request $request)
{
// Get product id from input field
$productid=$request->id;
// Get user id from Auth class
$userid=Auth::id();
// Get product quantity in product table
$product_quantity=Product::where(['id'=>$productid])->pluck('quantity')->first();

// If user is not login then redirect to login
if(!Auth::check())
{
// In response status is 201 then we will redirect to login in ajax page
return response()->json(['status'=>201]);
}
else
{
// To check if the product is already added in the cart
$count=Cart::where(['user_id'=>$userid,'product_id'=>$productid])->count();
if($count>0)
{
return response()->json(['status'=>202,'product-exist'=>'Product is already Exist!']);
}
// If the product is out of stock
else if($product_quantity<1)
{
return response()->json(['status'=>203,'product-not-available'=>'Sorry the product is not available!']);
}
// To add product to the cart
else
{
// Get product price from product table
$price=Product::where(['id'=>$productid])->pluck('selling_price')->first();
// Create an object of cart table
$obj=new Cart();
// Set data as given
$obj->user_id=$userid;
$obj->product_id=$productid;
$obj->quantity=1;
$obj->price=$price;
$obj->total=($price);
$save=$obj->save();
// If product is successfully saved in the cart
if($save)
{
// If product is added to the cart then it should be subtracted from the product quantity
$product=Product::where(['id'=>$productid])->first();
$product->update(['quantity'=>$product->quantity-1]);
return response()->json(['status'=>200,'product-added-to-cart'=>'Product is successfully added to Cart!']);
}    
}
}    
}

// Count total products in the cart
static function countCartProduct()
{
$userid=Auth::id();
$count=Cart::where(['user_id'=>$userid])->count();    
return response()->json(['data'=>$count]);
}

// Delete a product from the cart
public function destroy($id)
{
$userid=Auth::id();
$productid=$id;
// Get cart quantity 
$cart_quantity=Cart::where(['product_id'=>$productid,'user_id'=>$userid])->pluck('quantity')->first();
$cart=Cart::where(['user_id'=>$userid,'product_id'=>$id]);
$delete=$cart->delete();
if($delete)
{
// When cart is updated then product quantity in product should be updated
$product_quantity=Product::where(['id'=>$productid])->pluck('quantity')->first();
$product=Product::where(['id'=>$productid])->first();
$product->update(['quantity'=>$product_quantity+$cart_quantity]);

return response()->json(['cart-product-deleted'=>'Cart Product is successfully Deleted']);
}    
}
public function searchCartRecord()
{
// To check user is login or not
if(Auth::check())
{
// Get user id 
$userid=Auth::id();
// Select the product from cart table which is added by user
$products=Cart::join('products','carts.product_id','=','products.id')
->join('users','carts.user_id','=','users.id')
->where('carts.user_id','=', $userid)
->get(['products.id','products.name','products.photo','products.selling_price','carts.quantity']);
return response()->json(['products'=>$products]);
}
else
{
return redirect()->route('login');
}
}

public function update(Request $request, $id)
{
$productid=$id;
$userid=Auth::id();
// Get quantity from input field
$quantity=$request->input('quantity');
$price=Product::find($productid)->pluck('selling_price')->first();
$total=($quantity*$price);
$cart=Cart::where(['user_id'=>$userid,'product_id'=>$productid]);
$cart->update(['quantity'=>$quantity,'price'=>$price,'total'=>$total]);
// When cart is updated then product quantity in product should be updated
$product_quantity=Product::where(['id'=>$productid])->pluck('quantity')->first();
$product=Product::where(['id'=>$productid])->first();
$product->update(['quantity'=>($product_quantity-($quantity-1))]);
// Return response in json format
return response()->json(['cart-product-updated'=>'Cart is successfully Updated!']);
}

// Calculate cart total price
public function cartTotalPrice()
{
$userid=Auth::id();
$total=Cart::where(['user_id'=>$userid])->sum('total');
return response()->json(['cart-total-price'=>$total]);
}
}
