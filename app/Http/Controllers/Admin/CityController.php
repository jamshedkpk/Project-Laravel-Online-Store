<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
public function index()
{
$cities=City::all();    
return view('admin.city.city_index')->with(['cities'=>$cities]);
}
public function create()
{
$countries=Country::all();
$states=State::all();
return view('admin.city.city_create')->with(['countries'=>$countries,'states'=>$states]);
}

public function store(Request $request)
{

}

public function destroy($id)
{
}
}