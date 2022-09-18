<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Image;
use File;

class RoleController extends Controller
{

public function index()
{
$roles=Role::all();
return view('admin.role.role_index')->with(['roles'=>$roles]);    
}

public function create()
{
return view('admin.role.role_create');
}

public function store(Request $request)
{
$data=$this->validate($request,[
'name'=>'required',
]);
$save=Role::create($data);
if($save)
{
return redirect()->route('role-index')->with(['role-added'=>'Role is successfully Added!']);
}
}

public function destroy($id)
{
$role=Role::find($id);
$delete=$role->delete();
if($delete)
{
return redirect()->route('role-index')->with(['role-deleted'=>'Role is successfully Deleted!']);
}
}

public function edit($id)
{
$role=Role::find($id);
return view('admin.role.role_edit')->with(['role'=>$role]);
}

public function update(Request $request, $id)
{
$this->validate($request,[
'name'=>'required',
]);
$name=$request->name;
$role=Role::find($id);
$update=$role->update(['name'=>$name]);
if($update)
{
return redirect()->route('role-index')->with(['role-update'=>'Role is successfully Updated!']);
}
}

}