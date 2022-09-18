<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Auth;
class UserSeeder extends Seeder
{
public function run()
{
User::create([
'name'=>'admin',
'email'=>'admin@gmail.com',
'role_id'=>1,
'password'=>Hash::make('admin'),
'photo'=>'Photo is here',
'status'=>1
]);
User::create([
'name'=>'user',
'email'=>'user@gmail.com',
'role_id'=>2,
'password'=>Hash::make('admin'),
'photo'=>'Photo is here',
'status'=>1
]);
}


}
