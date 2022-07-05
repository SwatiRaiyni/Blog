<?php

namespace App\Http\Controllers\Auth;
use Closure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\CanResetPassword;


class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
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
            if($user[0]->UserType == 1){

                $status = Password::sendResetLink(
                    $request->only('email')
                );
               // print_r('email is  sent'); die;
                if($status == Password::RESET_LINK_SENT){
                    // print_r(__($status)); die;
                    return back()->with('status', __($status));
                }else{
                    return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
                }
            }else{
                return back()->with('msg','Backend user not able to reset password here.. ');
            }
        }else{
                return back()->with('msg','Oppes! we can not find this email Register');
        }

            // return $status == Password::RESET_LINK_SENT
            //             ?  back()->with('status', __($status))
            //             :  back()->withInput($request->only('email'))
            //                     ->withErrors(['email' => __($status)]);
            // $status = Password::sendResetLink(
            //     $request->only('email')
            // );



    }


}
