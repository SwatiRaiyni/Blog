<?php
namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPost;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App;




class ProfileManagementController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    public function index1($lang) {
       // dd(session()->all());
        App::setlocale($lang);
        $user = \Auth::user();
        $roles = $user->getRoles();
        return view('user.userdashboard', compact('roles'));
    }
    public function index11() {

        $user = \Auth::user();
        $roles = $user->getRoles();
        return view('user.userdashboard', compact('roles'));
    }



    public function changepass($lang,Request $res){
        App::setLocale($lang);
        $res->validate([
            'oldpassword' => 'required',
            'password' => 'required|string|min:6|same:password_confirmation',
            'password_confirmation' => 'required',
          ]);
          $user = \Auth::user();
          if (!\Hash::check($res->oldpassword, $user->password)) {
            return redirect()->route($lang.'/passwordchangeuser')->with('status1', 'Current password does not match!');
        }elseif($res->oldpassword == $res->password){
            return redirect()->route($lang.'/passwordchangeuser')->with('status1', 'You Enter Password which is same as your old password');
        }

        $user->password = \Hash::make($res->password);
        $user->save();
        return redirect()->route($lang.'/passwordchangeuser')->with('status', 'Password successfully changed!');
    }

    public function edituser1($lang){
        App::setLocale($lang);
        $data = User::find(Auth::user()->id);
        $dataname = explode(" ", $data->name);
        return view('user.profile.edituser',['data'=>$data , 'dataname'=>$dataname]);
    }
    public function update1($lang,Request $res){
        App::setLocale($lang);
        $res->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'dob' => ['required','before:today'],

        ]);
        $data = User::find($res->id);
        $data->name = $res->firstname." ".$res->lastname;
        $data->DOB = $res->dob;
        if($res->hasfile('image')){

            Storage::disk('public')->delete('images/userprofile/'.$data->Profile);
            $image = $res->file('image');
            $destination_path = 'public/images/userprofile';
            $img = $data->Profile = uniqid().$image->getClientOriginalName();
            $path = $res->file('image')->storeAs($destination_path, $img);
        }
        $data->UserType = 1;
        $data->update();
        $res->session()->flash('status','User Profile updated Successfully');
        return redirect($lang.'/user_dashboard1');
    }

}
