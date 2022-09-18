<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Collection;
use Exception;
class StateController extends Controller
{
public function index()
{

try
{
$states=State::with('country')->get();
return view('admin.state.state_index')->with(['states'=>$states]);
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
return view('admin.state.state_create');
}
catch(Exception $e)
{
$error=$e->getMessage(); 
return view('page_404')->with(['error'=>$error]);   
}

}

public function store(Request $request)
{
try
{
if($request->submit1=='submit1')
{
$url="https://api.countrystatecity.in/v1/states";
$api="ODJKSzBPcHc4ZFJuNzRxOWwyMllLVm5Wc0ZxMFk4cEN2VjhlQ3JCMg==";
$header=['X-CSCAPI-KEY'=>$api];
$states=Http::withHeaders($header)->get($url)->json();
foreach($states as $item)
{
$name=$item['name'];
$country_iso2=$item['country_code'];
$iso2=$item['iso2'];
$count=State::where(['name'=>$name,'iso2'=>$iso2])->count();
if($count==0)
{
$state=new State;
$state->name=$name;
$state->iso2=$iso2;
$state->country_iso2=$country_iso2;
$save=$state->save();    
}
}
return redirect()->route('state-index');    
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
$state=State::find($id);
$delete=$state->delete();
if($delete)
{
return redirect()->route('state-index')->with(['state-deleted'=>'State is successfully Deleted!']);    
}
}
catch(Exception $e)
{
$error=$e->getMessage(); 
return view('page_404')->with(['error'=>$error]);   
}    
}
}
