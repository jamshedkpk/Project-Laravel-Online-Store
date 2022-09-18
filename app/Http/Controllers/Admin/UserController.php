<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use File;
use App\Models\Country;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Role;

class UserController extends Controller
{
// Get all users detail for admin
public function index()
{
$users=User::all();
return view('admin.user.user_index')->with(['users'=>$users]);
}

// Create a new user by admin
public function create()
{
    $countries=Country::all();
    $states=State::all();
    $cities=City::all();    
    $roles=Role::all();
    $users= User::all();    
    return view('admin.user.user_create')->with(['users'=>$users,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'roles'=>$roles]);
}

// Store a new user by admin
public function store(Request $request)
{
$data=$this->validate($request,[
'name'=>'required',
'email'=>'required',
'password'=>'required|min:5',
'role_id'=>'required',
'country_id'=>'required|notIn:null',
'city_id'=>'required|notIn:null',
'state_id'=>'required|notIn:null',
'status'=>'required|notIn:null',
'address'=>'required',
'mobile'=>'required',
'photo'=>'required',
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
$fileRezise->save(public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'userPhoto'.DIRECTORY_SEPARATOR.$fileName));
$data['photo']='storage/userPhoto/'.$fileName;
}
$save=User::create($data);
if($save)
{
$users=User::all();
return redirect()->route('user-index')->with(['users'=>$users,'user-added'=>'User is successfully Added!']);
}
}

// Get one user detail for admin or user
public function viewProfile($id)
{
if(!Auth::check())
{
return redirect()->route('login');
}
else
{
$userid=$id;
$user=User::where(['id'=>$userid])->first();
$countries=Country::all();
$states=State::all();
$cities=City::all();
$roles=Role::all();
return view('admin.user.view_profile')->with(['user'=>$user,'countries'=>$countries,'states'=>$states,'cities'=>$cities]);    
}
}
// Return view for edit profile
public function editProfile($id)
{
$userid=$id;
$user=User::where(['id'=>$userid])->first();
$countries=Country::all();
$states=State::all();
$cities=City::all();
$roles=Role::all();
return view('admin.user.view_profile')->with(['user'=>$user,'countries'=>$countries,'states'=>$states,'cities'=>$cities]);    
}
// Return view for edit password
public function editPassword($id)
{
$user=User::where(['id'=>$id])->first();
return view('admin.user.edit_password')->with(['user'=>$user]);
}
// Return view for edit photo
public function editPhoto($id)
{
$user=User::where(['id'=>$id])->first();
return view('admin.user.edit_photo')->with(['user'=>$user]);
}

// Update user profile by admin or user
public function updateProfile(Request $request, $id)
{
$this->validate($request,
[
'name'=>'required',
'email'=>'required',
'country_id'=>'required',
'state_id'=>'required',
'city_id'=>'required',
'address'=>'required',
'mobile'=>'required',
]);
$user=User::where(['id'=>$id]);
$user->update(['name'=>$request->name,
'email'=>$request->email,
'country_id'=>$request->country_id,
'state_id'=>$request->state_id,
'city_id'=>$request->city_id,
'address'=>$request->address,
'mobile'=>$request->mobile,

]);
return back()->with(['user-updated'=>'Your Profile Is Successfully Updated']);
}
// Update user password
public function updatePassword(Request $request, $id)
{
$this->validate($request,
[
'password_old'=>'required',
'password_new'=>'required|confirmed|min:5',
'password_new_confirmation'=>'required|min:5',
]);
$old_password=$request->password_old;
$old_db_password=User::where(['id'=>$id])->pluck('password')->first();
if(Hash::check($old_password,$old_db_password))
{
$user=User::where(['id'=>$id]);
$user->update(['password'=>Hash::make($request->password_new)]);
return back()->with(['user-password-updated'=>'Your Password Is Successfully Updated!']);
}
else
{
return back()->with(['invalid_password'=>'Old Password Is Invalid!']);
}
}

// Update user photo
public function updatePhoto(Request $request, $id)
{
// Validate photo of user
$data=$this->validate($request,[
'photo'=>'required',
]);

// Create an object of user whose photo is updated
$user=User::where(['id'=>$id])->first();

// If photo is uploaded
if($request->hasFile('photo'))
{

// To delete previous image from storage folder
$path=$user->photo;
if(File::exists($path))
{
File::delete($path);
}



// Get original name of uploaded photo
$originalPhotoName=$request->file('photo')->getClientOriginalName();
// Get original extension of uploaded photo
$originalPhotoExtension=$request->file('photo')->getClientOriginalExtension();
// Get original path of uploaded photo
$originalPhoto=pathinfo($originalPhotoName,PATHINFO_FILENAME);
// File name which we want to store in DB
$filename=$originalPhoto. "_" .time(). "." .$originalPhotoExtension;

// Upload file to the directory
$photo=$request->file('photo');
$fileResize=Image::make($photo->getRealPath());
$fileResize->resize(300,300);
$fileResize->save('storage/UserPhoto/'.$filename);


// Update the catagory
$update=$user->update
([
'photo'=>'storage/userPhoto/'.$filename
]);
if($update)
{
return redirect()->back()->with(['user-deleted'=>'User is successfully Deleted!']);
}
}
}

// Delete a user
public function destroy($id)
{
$user=User::findOrFail($id);
$delete=$user->delete();
if($delete)
{
return redirect()->back();
}
}

// Update user status
public function updateStatus(Request $request, $id)
{
$status=$request->status;

$user=User::where(['id'=>$id]);;
$update=$user->update(['status'=>$status]);
if($update)
{
return redirect()->back()->with(['user-status-updated'=>'User status is successfully Updated!']);
}
}
}