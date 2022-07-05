<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Session;

use App\Models\User;
use Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Console\Output\ConsoleOutput;

use Exception;
use Mail;
use App\Mail\SendCodeMail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('destroy');

    }
    public function create()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {  // $request->authenticate();
        //dd(Auth::guard('web')->check());
        $user = User::where('email',$request->email)->first(); //dd($user->UserType);

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');
        if(Auth::guard('admin')->attempt($credentials)) {
            Auth::guard('admin')->login($user);
            $request->session()->regenerate();
            // if($user->UserType == 2){
            //     Auth::guard('admin')->login($user);
            //    // dd("yes");
            // }else{
            //     Auth::login($user);
            // }

            if(Auth::guard('admin')->user() && Auth::guard('admin')->user()->UserType == 2){

                if(Auth::guard('admin')->user()->IsApproved == 1){// dd("yes");
                    $a = date("Y-m-d H:i:s");
                    $find1 = User::where('id', Auth::guard('admin')->user()->id)
                        ->where('Lockout_End', '<=',$a)
                        ->first();

                    if(is_null($find1) && Auth::guard('admin')->user()->Lockout_End != ''){

                        Auth::guard('admin')->logout();
                       // $request->session()->invalidate();
                       // $request->session()->regenerateToken();
                        $request->session()->flash('msg','Oppes! Try again after 2 mins');
                       return redirect("admin/login");
                    }
                    elseif(!is_null($find1)){
                        //dd("yes");
                        auth()->guard('admin')->user()->generateCode1();
                       // return redirect()->route('2faadmin.index1');
                       return redirect('/en/2faadmin');
                    }
                }else{
                    Auth::guard('admin')->logout();
                    //$request->session()->invalidate();
                    //$request->session()->regenerateToken();
                    session()->flash('msg', 'You are not apporved by admin!');
                    return redirect('admin/login');
                }

            }
                else{
                    Auth::guard('admin')->logout();
                    //$request->session()->invalidate();
                    //$request->session()->regenerateToken();
                    session()->flash('msg', 'You not have a user access!');
                    return redirect('admin/login');
                }

            }

            $request->session()->flash('msg','Oppes! Invalid credentials');
            return redirect("admin/login");
    }
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
      // dd("inside admin");
        Auth::guard('admin')->logout();
        Session::forget('admin_2fa');
        //Auth::guard('admin')->logout()
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('admin/login');
    }
}
