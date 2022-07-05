<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'image' => ['required'],
            'dob' => ['required','before:today'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     'name' => $request->firstname." ".$request->lastname,
        //     'image' => $request->file('image'),
        //     'dob' => $request->dob,
        //     $image = $res->file('image');
        //     $destination_path = 'public/images';
        //     $img = $data->Image = uniqid().$image->getClientOriginalName();
        //     $path = $res->file('image')->storeAs($destination_path, $img);
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        $data = new User;
        $data->name =  $request->firstname." ".$request->lastname;
        $image = $request->file('image');
        $destination_path = 'public/images/userprofile';
        $img = $data->Profile = uniqid().$image->getClientOriginalName();
        $path = $request->file('image')->storeAs($destination_path, $img);
        $data->DOB = $request->dob;
        $data->email = $request->email;
        $data->Lockout_End = now();
        $data->password =Hash::make($request->password);

        $data->save();
        DB::table('role_user')->insert([
            'user_id' => $data->id,
            'role_id' => 2,
            'user_type'=>'users'
        ]);

        event(new Registered($data));

        Auth::login($data);
        auth()->user()->generateCode();
        return redirect()->route('2fa.index');
        //return redirect(RouteServiceProvider::HOME);

    }
}
