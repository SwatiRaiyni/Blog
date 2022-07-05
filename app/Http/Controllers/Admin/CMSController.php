<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App;

class CMSController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function cmsmanagement($lang){
        App::setLocale($lang);
        $data = CMS::whereNotNull('pagename_'.$lang)->get();
        return view('admin.cmsmanagement.cms',['data'=>$data]);
    }
    public function editcms($lang,$id){
        App::setLocale($lang);
        $data = CMS::find($id);
        //dd($data);
        return view('admin.cmsmanagement.editcms',['data'=>$data]);
    }
    public function updatecms($lang,Request $request){
        App::setLocale($lang);
        $request->validate([
            //'pagename'=>'required',
            'bannerheader'=>'required',
            'rightdescription'=>'required',
            'extradescription'=>'required'
        ]);
        $data = CMS::find($request->id);
       // $data->pagename = $request->pagename;
        $data['Banner_header_'.$lang] = $request->bannerheader;
        $data['Rightblock_'.$lang] = $request->rightdescription;
        $data['Extrablock_'.$lang] = $request->extradescription;


        if($request->hasfile('bannerimage')){
            Storage::disk('public')->delete('images/bannerimage/'.$data['Banner_image_'.$lang]);
            $image = $request->file('bannerimage');
            $destination_path = 'public/images/bannerimage';
            $img = $data['Banner_image_'.$lang] = uniqid().$image->getClientOriginalName();
            $path = $request->file('bannerimage')->storeAs($destination_path, $img);
        }
        if($request->hasfile('leftimage')){
            Storage::disk('public')->delete('images/leftblockimage/'.$data['LeftBlock_image_'.$lang]);
            $image = $request->file('leftimage');
            $destination_path = 'public/images/leftblockimage';
            $img = $data['LeftBlock_image_'.$lang] = uniqid().$image->getClientOriginalName();
            $path = $request->file('leftimage')->storeAs($destination_path, $img);
        }
        $data->update();
        $request->session()->flash('status',$request->pagename.' page updated Successfully');
        return redirect($lang.'/cmsmanagement');
    }


}
