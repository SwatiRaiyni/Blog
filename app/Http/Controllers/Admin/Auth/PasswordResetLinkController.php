<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkController extends Controller
{
     /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = DB::table('users')->where('email',$request->email)->get()->toArray();
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        if(!empty($user)){
            if($user[0]->UserType == 2){
                $status = Password::sendResetLink(
                    $request->only('email')
                );
                if($status == Password::RESET_LINK_SENT){
                    return back()->with('status', __($status));
                }else{
                    return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
                }
            }else{
                return back()->with('msg','Frontend user not able to reset password here.. ');
            }
        }else{
                return back()->with('msg','Oppes! we can not find this email Register');
        }




    }

}
