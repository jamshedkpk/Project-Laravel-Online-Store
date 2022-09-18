<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;

class StateController extends Controller
{
public function index(Request $request)
{
$country_iso2=$request->countryiso2;
$states=State::where(['country_iso2'=>$country_iso2])->get();
return response()->json(['states'=>$states]);    
}
}
