<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App;
use App\Models\UserPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiBlogController extends Controller
{
    public function userpostnew($lang){
        App::setlocale($lang);
        $currentDate = date('Y-m-d');
        $currentDate = date('Y-m-d', strtotime($currentDate));
        $data = User::join('user_post', 'users.id', '=','user_post.user_id_'.$lang )->where('user_post.Isactive_'.$lang, '=', 1)->where('user_post.start_date_'.$lang ,'<=', $currentDate)->where ('user_post.end_date_'.$lang,'>=',$currentDate)->paginate(5);
        return view('allpost')->with('data',$data)->render();
    }
    public function userpost($lang,Request $res){
      // dd($lang);
       if($lang == 'hi'){
           $lang = 'hi';
       }elseif($lang == 'en'){
           $lang = 'en';
       }else{
           $lang = 'en';
           //$data = '';
       }
       //dd($lang);
        App::setLocale($lang);
        $currentDate = date('Y-m-d');
        $currentDate = date('Y-m-d', strtotime($currentDate));
        $data = User::join('user_post', 'users.id', '=','user_post.user_id_'.$lang )->where('user_post.Isactive_'.$lang, '=', 1)->where('user_post.start_date_'.$lang ,'<=', $currentDate)->where ('user_post.end_date_'.$lang,'>=',$currentDate)->paginate(5);
        $data1 = trans('msg.posted by');
        $data2 = trans('msg.Read more');
        $data3 = trans('msg.search');
      //  dd($data1);
        if($res->ajax()){
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $data = User::join('user_post', 'users.id', '=','user_post.user_id_'.$lang )->where('user_post.Isactive_'.$lang, '=', 1)->where('user_post.start_date_'.$lang ,'<=', $currentDate)->where('user_post.end_date_'.$lang,'>=',$currentDate)->select('users.name AS uname','user_post.Title_'.$lang. ' AS Title', 'user_post.Description_'.$lang. ' as Description','user_post.start_date_'.$lang.' as start_date','user_post.end_date_'.$lang.' as end_date','user_post.Isactive_'.$lang.' as Isactive','user_post.id','user_post.Image_'.$lang. ' AS Image','user_post.user_id_'.$lang. ' AS user_id')->paginate(5);
            //return response()->json($data);
            return response()->json(['data'=>$data,'postedby'=>$data1,'readmore'=>$data2,'search'=>$data3, 'status' =>200 ]);
        }
        //dd($data);
        // return view('allpost')->with('data',$data)->render();
    }
    public function userpost1(Request $res){
        //dd("in1");
        $currentDate = date('Y-m-d');
        $currentDate = date('Y-m-d', strtotime($currentDate));
        $data = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.Isactive', '=', 1)->where('user_post.start_date' ,'<=', $currentDate)->where ('user_post.end_date','>=',$currentDate)->paginate(5);

        if($res->ajax()){
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $data = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.Isactive', '=', 1)->where('user_post.start_date' ,'<=', $currentDate)->where ('user_post.end_date','>=',$currentDate)->paginate(5);
            //return response()->json($data);
            return response()->json(['data'=>$data , 'status' =>200 ]);
        }
        return view('allpost')->with('data',$data)->render();
    }
    // public function viewallblog($id){
    //     $data = User::join('user_post','users.id','=','user_post.user_id')->where('user_post.id' , '=',$id)->get();
    //     return view('blogall',['data'=>$data]);
    // }
    public function viewallblog($lang,$id){
        App::setLocale($lang);
        $data1 = trans('msg.posted by');

        $data3 = trans('msg.search');
        $data = User::join('user_post','users.id','=','user_post.user_id_'.$lang)
        ->leftjoin('comments','user_post.id','=','comments.post_id')
        ->where('user_post.id' , '=',$id)
        ->select('users.name AS uname','user_post.Image_'.$lang.' as Image','user_post.Description_'.$lang .' as Description','user_post.Title_'.$lang .' as Title','user_post.start_date_'.$lang. ' as start_date','comments.name AS cname','comments.comment','comments.created_at','user_post.user_id_'.$lang. ' as user_id')
        ->get();
        return response()->json(['data'=>$data ,'postedby'=>$data1,'search'=>$data3 ,'status' =>200 ]);
    }
    public function viewallblog1($id){

        $data = User::join('user_post','users.id','=','user_post.user_id')
        ->leftjoin('comments','user_post.id','=','comments.post_id')
        ->where('user_post.id' , '=',$id)
        ->select('users.name AS uname','user_post.Image','user_post.Description','user_post.Title','user_post.start_date','comments.name AS cname','comments.comment','comments.created_at','user_post.user_id')
        ->get();
        return response()->json(['data'=>$data , 'status' =>200 ]);
    }
    // public function index(Request $request)
    // {
    //     $search =  $request->input('search');
    //     if($search!=""){
    //         $currentDate = date('Y-m-d');
    //         $currentDate = date('Y-m-d', strtotime($currentDate));
    //         $Members = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.Isactive', '=', 1)->where('user_post.start_date' ,'<=', $currentDate)->where ('user_post.end_date','>=',$currentDate)->where('user_post.Title', 'like', '%'.$search.'%')->paginate(5);
    //         $Members->appends(['q' => 'userpost']);
    //         return view('allpost',['data'=>$Members]);
    //     }else{
    //         $currentDate = date('Y-m-d');
    //         $currentDate = date('Y-m-d', strtotime($currentDate));
    //         $data = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.Isactive', '=', 1)->where('user_post.start_date' ,'<=', $currentDate)->where ('user_post.end_date','>=',$currentDate)->paginate(5);
    //         return view('allpost',['data'=>$data]);
    //     }

    // }
    public function index($lang,Request $request)
    {
        App::setLocale($lang);
        $search =  $request['name'];
        $data1 = trans('msg.posted by');
        $data2 = trans('msg.Read more');
        $data3 = trans('msg.search');
        if($search!=""){
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $Members = User::join('user_post', 'users.id', '=','user_post.user_id_'.$lang )->where('user_post.Isactive_'.$lang, '=', 1)->where('user_post.start_date_'.$lang ,'<=', $currentDate)->where ('user_post.end_date_'.$lang,'>=',$currentDate)->where('user_post.Title_'.$lang, 'like', '%'.$search.'%')->select('users.name AS uname','user_post.Title_'.$lang. ' AS Title', 'user_post.Description_'.$lang. ' as Description','user_post.start_date_'.$lang.' as start_date','user_post.end_date_'.$lang.' as end_date','user_post.Isactive_'.$lang.' as Isactive','user_post.id','user_post.Image_'.$lang. ' AS Image','user_post.user_id_'.$lang. ' AS user_id')->paginate(5);
            $Members->appends(['q' => 'userpost']);
           //dd($Members);
           return response()->json(['data'=>$Members,'postedby'=>$data1,'readmore'=>$data2,'search'=>$data3]);
        }else{
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $data = User::join('user_post', 'users.id', '=','user_post.user_id_'.$lang )->where('user_post.Isactive_'.$lang, '=', 1)->where('user_post.start_date_'.$lang ,'<=', $currentDate)->where ('user_post.end_date_'.$lang,'>=',$currentDate)->select('users.name AS uname','user_post.Title_'.$lang. ' AS Title', 'user_post.Description_'.$lang. ' as Description','user_post.start_date_'.$lang.' as start_date','user_post.end_date_'.$lang.' as end_date','user_post.Isactive_'.$lang.' as Isactive','user_post.id','user_post.Image_'.$lang. ' AS Image','user_post.user_id_'.$lang. ' AS user_id')->paginate(5);
            return response()->json(['data'=>$data,'postedby'=>$data1,'readmore'=>$data2,'search'=>$data3]);


        }

    }
    public function index1(Request $request)
    {
        $search =  $request['name'];
        if($search!=""){
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $Members = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.Isactive', '=', 1)->where('user_post.start_date' ,'<=', $currentDate)->where ('user_post.end_date','>=',$currentDate)->where('user_post.Title', 'like', '%'.$search.'%')->paginate(5);
            $Members->appends(['q' => 'userpost']);
           // return response()->json($Members);
           return response()->json($Members);
        }else{
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $data = User::join('user_post', 'users.id', '=','user_post.user_id' )->where('user_post.Isactive', '=', 1)->where('user_post.start_date' ,'<=', $currentDate)->where ('user_post.end_date','>=',$currentDate)->paginate(5);
            return response()->json($data);


        }

    }

}
