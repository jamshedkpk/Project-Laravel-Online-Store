<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use Image;
use File;
class CatagoryController extends Controller
{
// Get catagories
public function index()
{
$catagories=Catagory::all();
return view('admin.catagory.catagory_index')->with(['catagories'=>$catagories]);
}

// Create new catagory
public function create()
{
return view('admin.catagory.catagory_create');
}

// Store a catagory
public function store(Request $request)
{
// Validate catagory
$data=$this->validate($request,[
'name'=>'required|regex:/^[a-zA-Z ]+[-]?[_]?[.]?[a-zA-Z0-9 ]*$/',
'slug'=>'required',
'description'=>'required',
'meta_title'=>'required',
'meta_keyword'=>'required',
'meta_description'=>'required',
'status'=>'required|in:0,1',
'popular'=>'required|in:0,1',
'photo'=>'required|image'
]);
// If file is uploaded
if($request->hasFile('photo'))
{
// Get Name of uploaded File with Extension
$originalPhotoName=$request->file('photo')->getClientOriginalName();
// Get Extension of uploaded File
$originalPhotoExtension=$request->file('photo')->getClientOriginalExtension();
// Get Only Name of uploaded File
$orgininalPhoto=pathinfo($originalPhotoName,PATHINFO_FILENAME);
// Make a unique file name to store in DB
$filename=$orgininalPhoto. "_" .time(). "." .$originalPhotoExtension;
// Upload file to the directory & resize it
$photo=$request->file('photo');
$fileResize=Image::make($photo->getRealPath());
$fileResize->resize(300,300);
$fileResize->save('storage/catagoryPhoto/'.$filename);
// Store in data base
$data['photo']='storage/catagoryPhoto/'.$filename;
$save=Catagory::create($data);
if($save)
{
return redirect()->route('catagory-index')->with(['catagory-added'=>'Catagory is successfully Added']);    
}
}
}

// Edit catagory
public function edit($id)
{
$catagory=Catagory::find($id);
return view('admin.catagory.catagory_edit')->with(['catagory'=>$catagory]);
}

// Update catagory
public function update(Request $request, $id)
{
// Validate catagory
$this->validate($request,[
'name'=>'required|regex:/^[a-zA-Z ]+[-]?[_]?[.]?[a-zA-Z0-9 ]*$/',
'slug'=>'required',
'description'=>'required',
'meta_title'=>'required',
'meta_keyword'=>'required',
'meta_description'=>'required',
'status'=>'required|in:0,1',
'popular'=>'required|in:0,1',
'photo'=>'image'
]);

// Find the catagory which we want to update
$catagory=Catagory::find($id);

if($request->hasFile('photo'))
{
// To delete previous image from storage folder
$path=$catagory->photo;
if(File::exists($path))
{
File::delete($path);
}

// Get Name of uploaded File with Extension
$originalPhotoName=$request->file('photo')->getClientOriginalName();
// Get Extension of uploaded File
$originalPhotoExtension=$request->file('photo')->getClientOriginalExtension();
// Get Only Name of uploaded File
$orgininalPhoto=pathinfo($originalPhotoName,PATHINFO_FILENAME);
// File name which we want to store in DB
$filename=$orgininalPhoto. "_" .time(). "." .$originalPhotoExtension;
// Upload file to the directory
$photo=$request->file('photo');
$fileResize=Image::make($photo->getRealPath());
$fileResize->resize(300,300);
$fileResize->save('storage/catagoryPhoto/'.$filename);

// Update the catagory
$update=$catagory->update
([
'name'=>$request->name,
'slug'=>$request->slug,
'description'=>$request->description,
'meta_title'=>$request->meta_title,
'meta_keyword'=>$request->meta_keyword,
'meta_description'=>$request->meta_description,
'status'=>$request->status,
'popular'=>$request->popular,
'photo'=>'storage/catagoryPhoto/'.$filename
]);

if($update)
{
return redirect()->route('catagory-index')->with(['catagory-updated'=>'Catagory is successfully Updated']);
}
}
else
{
// Update the catagory
$update=$catagory->update
([
'name'=>$request->name,
'slug'=>$request->slug,
'description'=>$request->description,
'meta_title'=>$request->meta_title,
'meta_keyword'=>$request->meta_keyword,
'meta_description'=>$request->meta_description,
'status'=>$request->status,
'popular'=>$request->popular
]);
if($update)
{
return redirect()->route('catagory-index')->with(['catagory-updated'=>'Catagory is successfully Updated']);
}    
}
}

// Delete a catagory
public function destroy($id)
{
$catagory=Catagory::find($id);
// To delete image from storage folder
$path=$catagory->photo;
if(File::exists($path))
{
File::delete($path);
}
// To delete image from database
$delete=$catagory->delete();
if($delete)
{
return redirect()->route('catagory-index')->with(['catagory-deleted'=>'Catagory is successfully Deleted']);
}
}
}
