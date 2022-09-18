<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
public function __construct()
{
$this->middleware('auth');
}

public function index()
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
}
