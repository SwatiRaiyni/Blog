<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App;
use App\Models\UserPost;
use App\Models\User;
use App\Models\RoleUser;
 use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Facades\Config;
 use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    protected $rolesModel;
    protected $permissionModel;
    protected $assignPermissions;

    public function __construct() {

        $this->middleware('auth:admin');
        $this->rolesModel = Config::get('laratrust.models.role');
        $this->permissionModel = Config::get('laratrust.models.permission');
        $this->assignPermissions = Config::get('laratrust.panel.assign_permissions_to_user');
    }

    public function index($lang,Request $res){
        App::setLocale($lang);
        if($res->ajax()) {

            if(($res->name_sel != '') || ($res->email_sel != '') || ($res->role_sel != '') || ($res->status_sel != '') || ($res->type_sel != '')){

                $name =  $res->input('name_sel');
                $email =  $res->input('email_sel');
                $rolesel =  $res->input('role_sel');
                $statussel =  $res->input('status_sel');
                $typesel = $res->input('type_sel'); //dd($typesel);

                $q = DB::table('users')->leftjoin('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id');
                if($name != ''){
                    $q->where('users.name','like','%'.$name.'%');
                }if($email != ''){
                    $q->where('users.email','like',$email);
                }if ($statussel != ''){
                    $q->where('users.IsApproved','like',$statussel);
                }if($rolesel != ''){
                    $q->where('roles.display_name','like',$rolesel);
                }if($typesel != ''){
                    $q->where('users.UserType',$typesel);
                }

                $data = $q->select('users.name AS uname','users.DOB','users.UserType','users.Profile','users.IsApproved','users.email','roles.display_name','users.id')->get();


            }else{
                $data =  DB::table('users')->leftjoin('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name AS uname','users.DOB','users.UserType','users.Profile','users.IsApproved','users.email','roles.display_name','users.id')->get();

            }
            return Datatables::of($data)->make(true);
         }
         $data1 = DB::table('roles')->get();
         return view('admin.usermanagement.usermanagementserver',['data1'=>$data1]);
    }

        public function add($lang,Request $res){
            App::setLocale($lang);
            if($res->ajax()){
              $data1 = DB::table('roles')->where('UserType','=',$res->type_sel)->get();
              return json_encode($data1);
            }
            return view('admin.usermanagement.adduser');
        }

        public function createnewuser($lang,Request $request){
            App::setLocale($lang);
            $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'dob' => ['required','before:today'],
                'image' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'checktype' => ['required']
            ]);
            $data = new User;
            $data->name = $request->firstname." ".$request->lastname;
            $data->DOB = $request->dob;
            $image = $request->file('image');
            $destination_path = 'public/images/userprofile';
            $img = $data->Profile = uniqid().$image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $img);
            $data->email = $request->email;
            $data->IsApproved = $request->checkactive;
            $data->UserType = $request->checktype;
            $data->Lockout_End = now();
            $data->password = Hash::make($request->password);
            $data->save();

                DB::table('role_user')->insert([
                    'user_id' => $data->id,
                    'role_id' =>$request->roles,
                    'user_type'=>'users'
                ]);

            $request->session()->flash('status','New User Add  Successfully');
            return redirect($lang.'/usermangementajaxviewserverside');
           // return redirect('usermangementajaxview');
        }

        public function edituser($lang,$id){
            App::setLocale($lang);
            $data = User::find($id);
            $dataname = explode(" ", $data->name);
            $data1 = DB::table('roles')->where('UserType','=',$data->UserType)->get();

           $role = DB::table('role_user')->where('user_id','=',$id)->get();
            return view('admin.usermanagement.edituser',['data'=>$data , 'dataname'=>$dataname ,'data1'=>$data1 , 'role'=>$role]);
        }

        public function updateajax($lang,Request $res){
            App::setLocale($lang);
            if($res->ajax()){

                $data['role'] = DB::table('roles')->where('UserType',$res->type_sel)->get();
                $data['role_user'] = DB::table('role_user')->where('user_id','=',$res->id)->get();
                $option = '';
                foreach ($data['role_user'] as $role1){
                foreach ($data['role'] as $data){
                    $option .= "<option value='".$data->id."'>". $data->display_name ."</option>";
                }}
                return json_encode($option);
            }
        }

            public function update($lang,Request $res){
                App::setLocale($lang);

                $res->validate([
                    'firstname' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'dob' => ['required','before:today'],
                ]);



                if($res->roles != ''){
                    $affected = DB::table('role_user')->where('user_id',$res->id)->update(['role_id' =>$res->roles ]);
                }
                $data = User::find($res['id']);
                $data->name = $res->firstname." ".$res->lastname;
                $data->DOB = $res->dob;

                if($res->password != ''){
                    $res->validate([
                    'password' => [ 'confirmed', Rules\Password::defaults()]
                    ]);
                $data->password =  Hash::make($res->password);
                }
                if($res->checkactive != ''){
                $data->IsApproved = $res->checkactive;
                }
                if($res->checktype != ''){
                    $data->UserType = $res->checktype;
                }

                if($res->hasfile('image')){
                    Storage::disk('public')->delete('images/userprofile/'.$data->Profile);
                    $image = $res->file('image');
                    $destination_path = 'public/images/userprofile';
                    $img = $data->Profile = uniqid().$image->getClientOriginalName();
                    $path = $res->file('image')->storeAs($destination_path, $img);
                }

                $data->update();
                $res->session()->flash('status','Profile updated Successfully');
                //return redirect('usermangementajaxview');
                return redirect($lang.'/usermangementajaxviewserverside');
            }


        public function delete($lang,Request $req){
            App:setLocale($lang);
            $data1 = UserPost::where('user_id','=',$req->id)->get();
            foreach($data1 as $data){

                Storage::disk('public')->delete('images/'.$data->user_id.'/'.$data->Image);
                $data->delete();
            }


            $data = User::find($req->id);
            Storage::disk('public')->delete('images/userprofile/'.$data->Profile);
            $data->delete();
            $req->session()->flash('status1','User data is deleted');
            return redirect($lang.'/usermangementajaxviewserverside');
            //return redirect('usermangementajaxview');
        }
   public function changepass($lang,Request $res){
    App::setLocale($lang);
    $res->validate([
        'oldpassword' => 'required',
        'password' => 'required|string|min:6|same:password_confirmation',
        'password_confirmation' => 'required',
      ]);
      $user = \Auth::guard('admin')->user();
      if (!\Hash::check($res->oldpassword, $user->password)) {
        return redirect()->route('passwordchange')->with('status1', 'Current password does not match!');
    }elseif($res->oldpassword == $res->password){
        return redirect()->route('passwordchange')->with('status1', 'You Enter Password which is same as your old password');
    }

    $user->password = \Hash::make($res->password);
    $user->save();
    return redirect()->route('passwordchange')->with('status', 'Password successfully changed!');
    }

    public function usermangementajax(){

        $data =  DB::table('users')->leftjoin('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name AS uname','users.DOB','users.Profile','users.UserType','users.IsApproved','users.email','roles.display_name','users.id')->get();
        return json_encode($data);

    }

    public function usermangementajaxviewserverside(Request $res){

    if($res->ajax()) {
        if(!empty($res->name_sel) || !empty($res->email_sel) || !empty($res->name_sel) || !empty($res->role_sel) || !empty($res->status_sel)){
            $name =  $res['name_sel'];
            $email =  $res->input('email_sel');
            $rolesel =  $res->input('role_sel');
            $statussel =  $res->input('status_sel');
            $q = User::query();

            if($name != ''){
                $q->where('name','like','%'.$name.'%');
            }if($email != ''){
                $q->where('email','like',$email);
            }
            if ($statussel != ''){
                $q->where('IsApproved','like',$statussel);
            }
            $data = $q->leftjoin('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name AS uname','users.DOB','users.UserType','users.Profile','users.IsApproved','users.email','roles.display_name','users.id')->get();

        }else{
        $data =  DB::table('users')->leftjoin('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name AS uname','users.DOB','users.UserType','users.Profile','users.IsApproved','users.email','roles.display_name','users.id')->get();

        }
        return Datatables::of($data)->make(true);
     }
     $data1 = DB::table('roles')->get();
     return view('admin.usermanagement.usermanagementserver',['data1'=>$data1]);
    }

    public function searchuserdata1(Request $request){
        $data1 = DB::table('roles')->get();
        if($request->ajax()) {

        $name =  $request['name_sel'];
        $email =  $request->input('email_sel');
        $rolesel =  $request->input('role_sel');
        $statussel =  $request->input('status_sel');
        $q = User::query();

        if($name != ''){
            $q->where('name','like','%'.$name.'%');
        }if($email != ''){
            $q->where('email','like',$email);
        }
        if ($statussel != ''){
            $q->where('IsApproved','like',$statussel);
        }
        $sql = $q->leftjoin('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name AS uname','users.DOB','users.Profile','users.UserType','users.IsApproved','users.email','roles.display_name','users.id')->get();

        return Datatables::of($sql)->make(true);
    }
    return view('admin.usermanagement.usermanagementserver',['data1'=>$data1]);
    }






}
