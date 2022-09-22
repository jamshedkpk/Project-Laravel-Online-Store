<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catagory;
use Image;
use File;

class ProductController extends Controller
{

// Get products
public function index()
{
// Get all product with catagory function in product model
$products=Product::with('catagory')->get();
// Send to view
return view('admin.product.product_index')->with(['products'=>$products]);
}

// Create new product
public function create()
{
$catagories=Catagory::all();
return view('admin.product.product_create')->with(['catagories'=>$catagories]);    
}

// Store product in DB
public function store(Request $request)
{
// Validate product
$data=$this->validate($request,[
'name'=>'required|regex:/^[a-zA-Z ]+[-]?[_]?[.]?[a-zA-Z0-9 ]*$/',
'original_price'=>'required|numeric|min:1|max:100000',
'selling_price'=>'required|numeric|min:1|max:100000',
'description'=>'required',
'quantity'=>'required|numeric|min:1|max:1000',
'slug'=>'required|regex:/^[a-zA-Z ]+[-]?[_]?[.]?[a-zA-Z0-9 ]*$/',
'catagory_id'=>'required|notIn:null',
'status'=>'required|in:0,1',
'photo'=>'required|image'
]);
// If file is uploaded
if($request->hasFile('photo'))
{
// Get Name of uploaded File with Extension
$originalPhotoName=$request->file('photo')->getClientOriginalName();
// Get Name of uploaded File with Extension
$originalPhotoExtension=$request->file('photo')->getClientOriginalExtension();
// Get Only name of uploaded File
$originalPhoto=pathinfo($originalPhotoName,PATHINFO_FILENAME);
// Make a unique file name to store in DB
$fileName=$originalPhoto."-".time().".".$originalPhotoExtension;
// Upload file to the directory and & resize it
$photo=$request->file('photo');
$fileRezise=Image::make($photo->getRealPath());
$fileRezise->resize(300,300);
$fileRezise->save(public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'productPhoto'.DIRECTORY_SEPARATOR.$fileName));
$data['photo']='storage/userPhoto/'.$fileName;
}
$save=Product::create($data);
if($save)
{
return redirect()->route('product-index')->with(['product-added'=>'Product is successfully Added']);
}
}

// Edit a product
public function edit($id)
{
$catagories=Catagory::all();
$product=Product::find($id);
return view('admin.product.product_edit')->with(['product'=>$product,'catagories'=>$catagories]);
}

// Update a product
public function update(Request $request , $id)
{
$data=$this->validate($request,[
'name'=>'required|regex:/^[a-zA-Z ]+[-]?[_]?[.]?[a-zA-Z0-9 ]*$/',
'original_price'=>'required|numeric|min:1|max:100000',
'selling_price'=>'required|numeric|min:1|max:100000',
'description'=>'required',
'quantity'=>'required|numeric|min:1|max:1000',
'slug'=>'required|regex:/^[a-zA-Z ]+[-]?[_]?[.]?[a-zA-Z0-9 ]*$/',
'catagory_id'=>'required|notIn:null',
'status'=>'required|in:0,1',
'photo'=>'image'
]);
// Find the product which we want to update
$product=Product::find($id);
if($request->hasFile('photo'))
{
// First delete product image from storage folder
$path=$product->photo;
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
$fileResize->save('storage/productPhoto/'.$filename);

// update the product
$data['photo']=$filename;
$update=$product->update
([
'name'=>$request->name,
'original_price'=>$request->original_price,
'selling_price'=>$request->selling_price,
'description'=>$request->description,
'quantity'=>$request->quantity,
'slug'=>$request->slug,
'catagory_id'=>$request->catagory_id,
'status'=>$request->status,
'photo'=>'storage/productPhoto/'.$filename,
]);
if($update)
{
return redirect()->route('product-index')->with(['product-updated'=>'Product is successfully Updated']);
}
}
else
{
$update=$product->update
([
'name'=>$request->name,
'original_price'=>$request->original_price,
'selling_price'=>$request->selling_price,
'description'=>$request->description,
'quantity'=>$request->quantity,
'slug'=>$request->slug,
'catagory_id'=>$request->catagory_id,
'status'=>$request->status,
]);
if($update)
{
return redirect()->route('product-index')->with(['product-updated'=>'Product is successfully Updated']);
}
}
}

// Delete a product
public function destroy($id)
{
// Find the product which is to be deleted
$product=Product::find($id);
// First delete product image from storage folder
$path=$product->photo;
if(File::exists($path))
{
File::delete($path);
}
$delete=$product->delete();
if($delete)
{
return redirect()->route('product-index')->with(['product-deleted'=>'Product is successfully Deleted']);
}
}

}
