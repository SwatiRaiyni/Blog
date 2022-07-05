<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPost;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App;
use Illuminate\Support\Facades\DB;

class BlogManagementController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function userblog($lang){
        App::setlocale($lang);
       // $data = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.user_id_'.$lang,'=',auth()->id())->select('Title_' .$lang. ' as Title, Description_' .$lang. ' as Description,start_date_'.$lang.' as start_date,end_date_'.$lang.' as end_date,Isactive_'.$lang.' as Isactive')->get();
        $data = User::join('user_post', 'users.id', '=','user_post.user_id_'.$lang)->where('user_post.user_id_'.$lang,'=',auth()->id())->get();

        //$comment = Comment::where('post_id',$id)->get();//dd($comment);
        //dd($data);
        return view('user.blog.blog',['data'=>$data]);
    }

    public function userblog1(){

        $data = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.user_id','=',auth()->id())->get();
        return view('user.blog.blog',['data'=>$data]);
    }

    public function addblog1(){
        return view('user.blog.addblog');
    }

    public function addblog($lang){
        //dd("yes");
        App::setlocale($lang);
        return view('user.blog.addblog');
    }

    public function insert(Request $res,$lang){
        App::setlocale($lang);

       // dd('Title_'.$lang );
        $res->validate([
            'title'=>'required',
            'description'=>'required',
            'image' => 'required|image',
            'sdate' => 'required|date',
            'edate' => 'required|date|after:sdate'
        ]);

        $data = new UserPost;
        $data['Title_'.$lang] =  $res->title;
        $data['Description_'.$lang] = $res->description;
        $data['start_date_'.$lang] = $res->sdate;
        $data['end_date_'.$lang] = $res->edate;
        $data['user_id_'.$lang] = auth()->user()->id;
        $image = $res->file('image');
        $destination_path = 'public/images/blogimages/'.auth()->user()->id;
        $img = $data['Image_'.$lang] = uniqid().$image->getClientOriginalName();
        $path = $res->file('image')->storeAs($destination_path, $img);
        $data->save();
        $res->session()->flash('status','post inserted Successfully');
        return redirect($lang.'/userpost1');
    }


    public function insert1(Request $res){
        $res->validate([
            'title'=>'required',
            'description'=>'required',
            'image' => 'required|image',
            'sdate' => 'required|date',
            'edate' => 'required|date|after:sdate'
        ]);
        $data = new UserPost;
        $data->Title =  $res->title;
        $data->Description = $res->description;
        $data->start_date = $res->sdate;
        $data->end_date = $res->edate;
        $data->user_id = auth()->user()->id;
        $image = $res->file('image');
        $destination_path = 'public/images/blogimages/'.auth()->user()->id;
        $img = $data->Image = uniqid().$image->getClientOriginalName();
        $path = $res->file('image')->storeAs($destination_path, $img);
        $data->save();
        $res->session()->flash('status','post inserted Successfully');
        return redirect('userpost1');
    }

    public function edit1($id){
        $data = UserPost::find($id);
        return view('user.blog.editblog',['data'=>$data]);
    }
    public function edit($lang,$id){
        App::setlocale($lang);
        $data = UserPost::find($id);
        //dd($lang);
        return view('user.blog.editblog',['data'=>$data]);
    }
    public function update($lang,Request $res){
        App::setlocale($lang);
        $res->validate([
            'title'=>'required',
            'description'=>'required',
            'sdate'=>'required|date',
            'edate'=>'required|date|after:sdate'
        ]);
       // dd($lang);

        $data = UserPost::find($res->id);
        $data['Title_'.$lang] =  $res->title;
        $data['Description_'.$lang] = $res->description;
        $data['start_date_'.$lang] = $res->sdate;
        $data['end_date_'.$lang] = $res->edate;
        $data['user_id_'.$lang] = auth()->user()->id;
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
        return redirect($lang.'/userpost1');
    }
    public function update1(Request $res){

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
        return redirect('userpost1');
    }

    public function delete1(Request $req){
        $data = UserPost::find($req->id);
        Storage::disk('public')->delete('images/blogimages/'.$data->user_id.'/'.$data->Image);
        $data->delete();
        $req->session()->flash('status1','Post data is deleted');
        return redirect('userpost1');
    }
    public function delete($lang,Request $req){
        App::setlocale($lang);
        $data = UserPost::find($req->id);
        Storage::disk('public')->delete('images/blogimages/'.$data['user_id_'.$lang].'/'.$data['Image_'.$lang]);
        $data->delete();
        $req->session()->flash('status1','Post data is deleted');
        return redirect($lang.'/userpost1');
    }
    public function viewallbloguser($lang,$id){
        App::setlocale($lang);
        $data = User::join('user_post','users.id','=','user_post.user_id_'.$lang)->where('user_post.id' , '=',$id)->get();//dd($data);
        $comment = Comment::where('post_id',$id)->get();//dd($comment);
        return view('user.blog.blogcomplete',['data'=>$data , 'comment'=>$comment]);
    }
    public function viewallbloguser1($id){
        $data = User::join('user_post','users.id','=','user_post.user_id')->where('user_post.id' , '=',$id)->get();//dd($data);
        $comment = Comment::where('post_id',$id)->get();//dd($comment);
        return view('user.blog.blogcomplete',['data'=>$data , 'comment'=>$comment]);
    }


}
