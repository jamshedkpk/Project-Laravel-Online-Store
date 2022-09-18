<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Http;
use DB;
use Exception;

class CountryController extends Controller
{
public function index()
{
try
{
$countries=Country::all();
return view('admin.country.country_index')->with(['countries'=>$countries]);
}
catch(Exception $e)
{
$error=$e->getMessage();
return view('page_404')->with(['error'=>$error]);
}
}

public function create()
{
try
{
return view('admin.country.country_create');
}
catch(Exception $e)
{
$error=$e->getMessage();
return view('page_404')->with(['error'=>$error]);
}
}
// Fetch countries api data and store in database
public function store(Request $request)
{
try
{
// When button is clicked then call api 
if($request->submit=='submit')
{
// Url of API 
$url="https://api.countrystatecity.in/v1/countries";
// API key
$api="ODJKSzBPcHc4ZFJuNzRxOWwyMllLVm5Wc0ZxMFk4cEN2VjhlQ3JCMg==";
// Header of API
$header=['X-CSCAPI-KEY'=>$api];
// Store API data in variable
$countries=Http::withHeaders($header)->get($url)->json();
// Access each item in data
foreach($countries as $item)
{
$name=$item['name'];
$iso2=$item['iso2'];
// Count record in db
$count=Country::where(['name'=>$name,'iso2'=>$iso2])->count();
// Store if record is not exist
if($count==0)
{
// Store in DB
$obj=new Country;
$obj->name=$name;
$obj->iso2=$iso2;
$obj->save();
}
}
return redirect()->route('country-index');
}   
}
catch(Exception $e)
{
$error=$e->getMessage();
return view('page_404')->with(['error'=>$error]);
}
}

public function destroy($id)
{
try
{
$country=Country::find($id);
$delete=$country->delete();
if($delete)
{
return redirect()->route('country-index')->with(['country-deleted'=>'Country is successfully Deleted!']);    
}
}        
catch(Exception $e)
{
$error=$e->getMessage();
return view('page_404')->with(['error'=>$error]);
}
}

}