<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Console\Output\ConsoleOutput;
use Session;
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
        $this->middleware('guest')->except('destroy');

    }
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(LoginRequest $request)
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();


    //     if(Auth::user()->hasRole('admin')){
    //         if(Auth::user()->IsApproved == 1){
    //             return redirect('admin_dashboard1');
    //         } else{

    //             Auth::guard('web')->logout();
    //             $request->session()->invalidate();
    //             $request->session()->regenerateToken();
    //             session()->flash('msg', 'You are not apporved by admin!');

    //             return redirect('login');
    //         }
    //     }elseif(!Auth::user()->hasRole('admin') ){
    //         if(Auth::user()->IsApproved == 1){
    //             return redirect('user_dashboard1');
    //        }
    //         else{

    //             Auth::guard('web')->logout();
    //             $request->session()->invalidate();
    //             $request->session()->regenerateToken();
    //             session()->flash('msg', 'You are not apporved by admin!');

    //             return redirect('login');
    //         }
    //     }
    // }
    public function store(Request $request)
    {
        $user = User::where('email',$request->email)->first();//dd($user);


        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

       // $user = User::where('email',$request->email)->first();
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            // if($user->UserType == 2){

            //     Auth::guard('admin')->login($user);

            // }else{
            //    // Auth::login($user);
            //     Auth::login($user);

            // }
            Auth::login($user);
            $request->session()->regenerate();
            //$request->authenticate();
           // dd(Auth::guard('web')->check());
            if(Auth::guard('web')->user() && Auth::guard('web')->user()->UserType == 1){ //dd();
                if(Auth::user()->IsApproved == 1){
                    $a = date("Y-m-d H:i:s");
                    $find1 = User::where('id', Auth::user()->id)
                        ->where('Lockout_End', '<=',$a)
                        ->first();

                    if(is_null($find1) && Auth::user()->Lockout_End != ''){

                        Auth::guard('web')->logout();
                       // $request->session()->invalidate();
                       // $request->session()->regenerateToken();
                        $request->session()->flash('msg','Oppes! Try again after 2 mins');
                       return redirect("en/login");
                    }
                    elseif(!is_null($find1)){

                        auth()->user()->generateCode();
                        return redirect()->route('2fa.index');
                    }
                }else{
                    Auth::guard('web')->logout();
                   // $request->session()->invalidate();
                   // $request->session()->regenerateToken();
                    session()->flash('msg', 'You are not apporved by admin!');
                    return redirect('en/login');
                }

            }
                else{ //dd("admin");
                    Auth::guard('web')->logout();
                    //$request->session()->invalidate();
                    //$request->session()->regenerateToken();
                    session()->flash('msg', 'You not have a admin access!');
                    return redirect('en/login');
                }

            }

            $request->session()->flash('msg','Oppes! Invalid credentials');
            return redirect("en/login");
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        Session::forget('user_2fa');
       // $request->session()->invalidate();

        //$request->session()->regenerateToken();

        return redirect('/en/login');
    }
}
