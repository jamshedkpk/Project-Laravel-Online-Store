<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CheckoutController extends Controller
{
// This function will fetch cart data to checkout page
public function index()
{
// Get user id from Auth class
$userid=Auth::id();
// Get all products of user in the cart
$cartItems=Cart::join('products','products.id','=','carts.product_id')
->join('users','users.id','=','carts.user_id')
->select(
'products.name as productname',
'products.selling_price as productprice',
'products.photo as productphoto',
'carts.quantity as quantity',
'carts.total as total')
->get();
// Get user detail
$user=User::where(['id'=>$userid])->
select(
'users.name as username',
'users.email as useremail',
'users.country_iso2 as usercountry',
'users.state_iso2 as userstate',
'users.city_iso2 as usercity',
'users.mobile as usermobile',
'users.address as useraddress',
)->first();
$totalPrice=Cart::where(['user_id'=>$userid])->sum('total');
$countries=Country::all();
$states=State::all();
$cities=City::all();
return view('layouts.frontend.checkout',compact(
    'cartItems',
    'user',
    'totalPrice',
    'countries',
    'states',
    'cities'
)); 
}

// This function will place order means it will store user order in order table
public function placeOrder(Request $request)
{
// Place order information in order table
$userid=Auth::id();
$cart=Cart::where(['user_id'=>$userid])->count();
if($cart<1)
{
return redirect()->route('cart-index');
}
else
{
// Update users information in user table for this order
$country=$request->country_iso2;
$state=$request->state_iso2;
$city=$request->city_iso2;
$user=User::where(['id'=>$userid]);
$this->validate($request,[
'name'=>'required',
'email'=>'required',
'country_iso2'=>'required|notIn:0',
'mobile'=>'required',
'address'=>'required'
]);
// If state is not updated 
if($request->state_iso2==null)
{
$stateiso2=User::where(['id'=>auth::id()])->pluck('state_iso2')->first();
$user->update(['state_iso2'=>$stateiso2]);
}
// if city is not updated
else if($request->city_iso2==null)
{
$cityiso2=User::where(['id'=>auth::id()])->pluck('city_iso2')->first();
$user->update(['state_iso2'=>$cityiso2]);
}
// if all updated
else
{
    $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'country_iso2'=>$request->country_iso2,
        'state_iso2'=>$request->state_iso2,
        'city_iso2'=>$request->city_iso2,
        'mobile'=>$request->mobile,
        'address'=>$request->address
        ]);    
}

// Store order informations in order table
$total=Cart::where(['user_id'=>$userid])->sum('total');
$order=New Order();
$order->user_id=$userid;
$order->token="Order"."_".time()."_".random_int(000,999);
$order->date=date('d-M-Y');
$order->status=0;
$order->total=$total;
$order->type="Offline";
$order->payment=0;
$order->save();

// Place order items information in orderitem table

// Get product information
$cartItems=Cart::join('products','products.id','=','carts.product_id')
->join('users','users.id','=','carts.user_id')
->select(
'products.id as productid',
'products.name as productname',
'products.selling_price as productprice',
'products.photo as productphoto',
'carts.quantity as quantity',
'carts.total as total')
->get();
// Get order id from order table
$orderid=Order::where(['user_id'=>$userid])->pluck('id')->first();
// As their are multiple items in user order so we use foreach loop to store in order items table
foreach($cartItems as $item)
{
OrderItem::create([
'order_id'=>$orderid,
'product_id'=>$item->productid,
'quantity'=>$item->quantity,
'price'=>$item->productprice,
'total'=>$item->total,
]);
}
$cart=Cart::where(['user_id'=>$userid]);
$cart->delete();
return redirect()->route('payment-index',$order->id);
}
}
}
