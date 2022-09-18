<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
use AuthenticatesUsers;

/**
 * Where to redirect users after login.
 *
 * @var string
 */
//protected $redirectTo = RouteServiceProvider::HOME;
public function authenticated()
{
// Check if user is admin or not
$role=auth()->user()->checkRole();
if($role=='admin')
{
return redirect('/dashboard')->with('status','Welcome To Admin');
}
else
{
return redirect('/')->with('status','Welcome To User');
}
}
/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
$this->middleware('guest')->except('logout');
}
}
