<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct(){
        //1$this->middleware('throttle:3,1')->only('2fa');

                 //$this->middleware('auth:admin');


    }
    public function index1()
    {   //dd(Auth::guard('admin')->check());
       // dd("yes");
        return view('admin.2faadmin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function store(Request $request)
    {

        $request->validate([
            'code'=>[
                'required'
            ]
        ]);
        $find1 = User::where('id', Auth::guard('admin')->user()->id)
            ->where('updated_at', '>=', now()->subMinutes(5))
            ->first();
        if(is_null($find1)){
            //dd("yes");
            $array['status'] = 'expire';
            $array['msg'] = 'The two factor code you have entered is expire click button to get new code';
            echo json_encode(['data'=>$array]);

        }
        elseif (!Hash::check($request->code, Auth::guard('admin')->user()->two_factor_recovery_codes)) {

            $id = User::find(Auth::guard('admin')->user()->id);
            $id->LockCount = Auth::guard('admin')->user()->LockCount + 1;
            $id->save();
            if($id->LockCount >= 3){
                $t=time()+(60*2);
                $id->Lockout_End = date("Y-m-d H:i:s",$t);

                $id->LockCount = 0;

                $id->save();
                Auth::guard('admin')->logout();
               // $request->session()->invalidate();
               // $request->session()->regenerateToken();
                session()->flash('msg', 'Oppes! Try again after 2 mins');

               $result = 'no';
                echo json_encode(['data'=>$result]);

            }else{
            $array['status'] = 'error';
            $array['msg'] = 'The two factor code you have entered does not match';
            echo json_encode(['data'=>$array]);}

        }
        elseif( !is_null($find1) && Hash::check($request->code, Auth::guard('admin')->user()->two_factor_recovery_codes)) {
            $id = User::find(Auth::guard('admin')->user()->id);
            $id->LockCount = 0;
            $id->save();
            Session::put('admin_2fa', Auth::guard('admin')->user()->id);

           // if($id->hasRole('admin') ){
            //dd(Auth::user('admin')->check());
                $result = 'Admin';
                echo json_encode(['data'=>$result]);
            // }else{
            //     $result = 'user';
            //     echo json_encode(['data'=>$result]);
            // }

        }





    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {

        auth()->guard('admin')->user()->generateCode1();

        return back()->with('success', 'We sent you code on your email.');
    }
}
