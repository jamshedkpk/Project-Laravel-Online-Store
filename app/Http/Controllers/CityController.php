<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
public function index(Request $request)
{
$country_iso2=$request->countryiso2;
// Url of API 
$url="https://api.countrystatecity.in/v1/countries/$country_iso2/cities";
// API key
$api="ODJKSzBPcHc4ZFJuNzRxOWwyMllLVm5Wc0ZxMFk4cEN2VjhlQ3JCMg==";
// Header of API
$header=['X-CSCAPI-KEY'=>$api];
// Store API data in variable
$cities=Http::withHeaders($header)->get($url)->json();
return response()->json(['cities'=>$cities]);
}
}
