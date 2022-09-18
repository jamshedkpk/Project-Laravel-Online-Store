<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PaymentController extends Controller
{
public function index($orderid)
{
$total=Order::where(['id'=>$orderid])->pluck('total')->first();
return view('layouts.frontend.payment')->with(['total'=>$total,'orderid'=>$orderid]);
}
public function updateOrderPayment($orderId)
{
$order=Order::where(['id'=>$orderId]);
$order->update(['payment'=>1]);
}
}
