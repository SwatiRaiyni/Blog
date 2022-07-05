<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Http\Request;
use App\Models\UserPost;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Comment;
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


class BlogManagementController extends Controller
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
    public function userblog($lang){
        App::setlocale($lang);
        //$data = UserPost::where('Title_'.$lang,'like','%'.$lang.'%')->select('user_post.Title_'.$lang)->get();
        $data = UserPost::whereNotNull('Title_'.$lang)->get();
        //dd($data);
        return view('admin.blogmanagement.blog',['data'=>$data]);
    }
    public function userblog1(){
        //App::setlocale($lang);
        $data = UserPost::all();
        return view('admin.blogmanagement.blog',['data'=>$data]);
    }
    public function editpost1($id){
        $data = UserPost::find($id);
        return view('admin.blogmanagement.editblog',['data'=>$data]);
    }
    public function editpost($lang,$id){
        App::setLocale($lang);
        $data = UserPost::find($id);
        return view('admin.blogmanagement.editblog',['data'=>$data]);
    }
    public function updatepost($lang,Request $res){
        App::setLocale($lang);
        $res->validate([
            'title'=>'required',
            'description'=>'required',
            'sdate'=>'required|date',
            'edate'=>'required|date|after:sdate'
        ]);
        $data = UserPost::find($res->id);
        $data['Title_'.$lang] =  $res->title;
        $data['Description_'.$lang] = $res->description;
        $data['start_date_'.$lang] = $res->sdate;
        $data['end_date_'.$lang] = $res->edate;
        $data['Isactive_'.$lang] = $res->checkactive;

        if($res->hasfile('image')){
            Storage::disk('public')->delete('images/blogimages/'.$data['user_id_'.$lang].'/'.$data['Image_'.$lang]);
            $image = $res->file('image');
            $destination_path = 'public/images/blogimages/'.$data['user_id_'.$lang];
            $img = $data['Image_'.$lang] = uniqid().$image->getClientOriginalName();
            $path = $res->file('image')->storeAs($destination_path, $img);
        }
        $data->update();
        $res->session()->flash('status','Post updated Successfully');
        return redirect($lang.'/user_blog');
    }

    public function updatepost1(Request $res){

        $res->validate([
            'title'=>'required',
            'description'=>'required',
            'sdate'=>'required|date',
            'edate'=>'required|date|after:sdate'
        ]);
        $data = UserPost::find($res->id);
        $data->Title = $res->title;
        $data->Description = $res->description;
        $data->start_date = $res->sdate;
        $data->end_date = $res->edate;
        $data->Isactive = $res->checkactive;
        if($res->hasfile('image')){
            Storage::disk('public')->delete('images/blogimages/'.$data->user_id.'/'.$data->Image);
            $image = $res->file('image');
            $destination_path = 'public/images/blogimages/'.$data->user_id;
            $img = $data->Image = uniqid().$image->getClientOriginalName();
            $path = $res->file('image')->storeAs($destination_path, $img);
        }
        $data->update();
        $res->session()->flash('status','Post updated Successfully');
        return redirect('user_blog');
    }
    public function viewallblog($lang,$id){
        App::setLocale($lang);
        $comment = Comment::where('post_id',$id)->get();
        $data = User::join('user_post','users.id','=','user_post.user_id_'.$lang)->where('user_post.id' , '=',$id)->get();//dd($data);
        return view('admin.blogmanagement.blogcomplete',['data'=>$data ,'comment'=>$comment]);
    }
    public function viewallblog1($id){
        $comment = Comment::where('post_id',$id)->get();
        $data = User::join('user_post','users.id','=','user_post.user_id')->where('user_post.id' , '=',$id)->get();//dd($data);
        return view('admin.blogmanagement.blogcomplete',['data'=>$data ,'comment'=>$comment]);
    }
    public function deletepost($lang,Request $req){
        App::setLocale($lang);
        $data = UserPost::find($req->id);
        Storage::disk('public')->delete('images/blogimages/'.$data['user_id_'.$lang].'/'.$data['Image_'.$lang]);
        $data->delete();
        $req->session()->flash('status1','Post data is deleted');
        return redirect($lang.'/user_blog');
    }
    public function deletepost1(Request $req){
        $data = UserPost::find($req->id);
        Storage::disk('public')->delete('images/blogimages/'.$data->user_id.'/'.$data->Image);
        $data->delete();
        $req->session()->flash('status1','Post data is deleted');
        return redirect('user_blog');
    }
    public function index1(){

        $user = \Auth::guard('admin')->user();
        $roles = $user->getRoles();
       //    dd(session()->all());
        return view('admin.admindashboard', compact('roles'));
    }
    public function index(){
        return view('layouts.backend_user.layout');
    }











}
