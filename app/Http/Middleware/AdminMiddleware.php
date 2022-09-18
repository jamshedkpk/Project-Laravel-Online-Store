<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
public function handle(Request $request, Closure $next)
{
    // Check if user is authenticated or not
    if(Auth::check())
    {
    // Check if user is admin or not
    $role=auth()->user()->checkRole();
    if($role=='admin')
    {
        return $next($request);
    }
    else
    {
        return redirect('/home')->with('status','Access Denied');
    } 
    }
    else
    {
    return redirect('/home')->with('status','Please Login First');
    }
    
}
}
