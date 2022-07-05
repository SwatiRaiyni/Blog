<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPost;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App;
class ApiCMSController extends Controller
{

    public function cms($lang,$id){
        App::setLocale($lang);
        $data = DB::table('cms')->where('id','=',$id)->select('pagename_'.$lang .' as pagename','Banner_header_'.$lang. ' as Banner_header','Banner_image_'.$lang. ' as Banner_image','LeftBlock_image_'.$lang. ' as LeftBlock_image','Rightblock_'.$lang. ' as Rightblock','Extrablock_'.$lang. ' as Extrablock')->get();
       // return response()->json($data);
        return response()->json(['data' => $data,'status'=> 200]);

    }
    // public function aboutcms(){
    //     $data = DB::table('c_m_s')->where('id','=',3)->get(); //dd($data);
    //     return response()->json($data);

    // }

    // public function termsandconditioncms(){
    //     $data = DB::table('c_m_s')->where('pagename','=','terms and condition')->get(); //dd($data);
    //     return response()->json($data);

    // }

    // public function privacycms(){
    //     $data = DB::table('c_m_s')->where('pagename','=','Privacy Policy')->get(); //dd($data);
    //     return response()->json($data);

    // }

    // public function howitworkcms(){
    //     $data = DB::table('c_m_s')->where('pagename','=','How its work')->get(); //dd($data);
    //     return response()->json($data);

    // }

    // public function contactcms(){
    //     $data = DB::table('c_m_s')->where('pagename','=','contact us')->get(); //dd($data);
    //     return response()->json($data);

    // }

}
