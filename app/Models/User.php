<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Exception;
use Mail;
use App\Mail\SendCodeMail;




class User extends Authenticatable
{

    use LaratrustUserTrait,HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_recovery_codes',
        'LockCount'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'Lockout_End' =>'datetime'
    ];

    // function generateRandomString($length = 25) {
    //     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    public function generateCode()
    {

       // $code = $this->generateRandomString(6);
        $code = rand(100000, 999999);
        $hashcode = Hash::make($code);
        $id = User::find(Auth::user()->id);
        $id->two_factor_recovery_codes =  $hashcode ;
        $id->save();
        try {

            $details = [
                'title' => 'Your two factor authentication code is web:',
                'code' => $code ,
                'name' => Auth::user()->name
            ];

            Mail::to(Auth::user()->email)->send(new SendCodeMail($details));

             }
             catch (Exception $e) {
                info("Error: ". $e->getMessage());
            }
    }
    public function generateCode1()
    {
        //dd("yes");
        $code = rand(100000, 999999);
        $hashcode = Hash::make($code);
        $id = User::find(Auth::guard('admin')->user()->id);
        $id->two_factor_recovery_codes =  $hashcode ;
        $id->save();
        try {

            $details = [
                'title' => 'Your two factor authentication code is admin:',
                'code' => $code ,
                'name' => Auth::guard('admin')->user()->name
            ];
           // dd(Auth::guard('admin')->user()->email);

            Mail::to(Auth::guard('admin')->user()->email)->send(new SendCodeMail($details));

             }
             catch (Exception $e) {
                info("Error: ". $e->getMessage());
            }
    }
}
