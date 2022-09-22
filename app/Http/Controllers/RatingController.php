<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class RatingController extends Controller
{
public function index()
{

}
public function addRate(Request $request)
{
$user_id=Auth::id();
$product_id=$request->product_id;
$rating=$request->rating;
// If user is login or not
if($user_id)
{
$data=Rating::where(['product_id'=>$product_id,'user_id'=>$user_id])->count();
// If user has already rate the product then only update it
if($data>0)
{
$obj=Rating::where(['user_id'=>$user_id,'product_id'=>$product_id]);
$obj->update(['star_rating'=>$rating]);
return back()->with(['rate-updated'=>'Your Rating is successfully Updated!']);
}    
// If user is new then insert his rating
else
{
$obj=new Rating();
$obj->user_id=$user_id;
$obj->product_id=$product_id;
$obj->star_rating=$rating;
$save=$obj->save();
if($save)
{
return back()->with(['rate-added'=>'Your Rating is successfully Added!']);
}    
}
}
else
{
return redirect()->route('login');
}
}
}
