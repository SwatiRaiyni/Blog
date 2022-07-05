<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::GET('/','App\Http\Controllers\PostController@userpost')->name('userpost');
//Route::GET('/userpost','App\Http\Controllers\PostController@userpost')->name('userpost');
//Route::GET('/viewallblog1/{id}','App\Http\Controllers\PostController@viewallblog')->name('viewallblog');
//Route::GET("/search",'App\Http\Controllers\PostController@index')->name('search');

// Route::GET('/aboutcms','App\Http\Controllers\CMSController@aboutcms')->name('aboutcms');
// Route::GET('/termsandconditioncms','App\Http\Controllers\CMSController@termsandconditioncms')->name('termsandconditioncms');
// Route::GET('/privacycms','App\Http\Controllers\CMSController@privacycms')->name('privacycms');
// Route::GET('/howitworkcms','App\Http\Controllers\CMSController@howitworkcms')->name('howitworkcms');
// Route::GET('/contactcms','App\Http\Controllers\CMSController@contactcms')->name('contactcms');

////Route::view('/','welcome')->name('welcome');
//Route::GET('/{lang}','App\Http\Controllers\api\ApiBlogController@userpost')->name('userpost');




Route::GET('/{lang}','App\Http\Controllers\Api\ApiBlogController@userpostnew')->name('userpostnew');
Route::get('/en/2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::POST('/2fa1', 'App\Http\Controllers\TwoFAController@store')->name('2fa1');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

Route::get('/en/2faadmin', [App\Http\Controllers\Admin\TwoFAController::class, 'index1'])->name('2faadmin.index1');
Route::POST('/2fa11', 'App\Http\Controllers\Admin\TwoFAController@store')->name('2fa11');
Route::get('2fa/reset1', [App\Http\Controllers\Admin\TwoFAController::class, 'resend'])->name('2faadmin.resend');



Route::group(['middleware' => 'disable_back_btn' ], function () {
Route::middleware('2fa')->group(function () {
Route::middleware('is_user')->group(function () {
Route::middleware('auth')->group(function () {


//Route::get('/user_dashboard1', 'App\Http\Controllers\ProfileManagementController@index11')->name('user_dashboard1');
Route::get('{lang}/user_dashboard1', 'App\Http\Controllers\ProfileManagementController@index1')->name('user_dashboard1');

Route::GET('{lang}/editprofile','App\Http\Controllers\ProfileManagementController@edituser1')->name('editprofile');
Route::POST('{lang}/editprofile','App\Http\Controllers\ProfileManagementController@update1')->name('editprofile');

Route::view('{lang}/passwordchangeuser','user.profile.passwordchange')->name('passwordchangeuser');
Route::POST('{lang}/changepassuser','App\Http\Controllers\ProfileManagementController@changepass')->name('changepassuser');


Route::get('/{lang}/userpost1','App\Http\Controllers\BlogManagementController@userblog')->name('user_blog');
//Route::get('/userpost1','App\Http\Controllers\BlogManagementController@userblog1')->name('user_blog');


//Route::get('add_post','App\Http\Controllers\BlogManagementController@addblog1')->name('add_blog');
Route::get('/{lang}/add_post','App\Http\Controllers\BlogManagementController@addblog')->name('add_blog');

Route::post('/{lang}/insert','App\Http\Controllers\BlogManagementController@insert')->name('insert');
//Route::post('/insert','App\Http\Controllers\BlogManagementController@insert1')->name('insert');


//Route::GET('/editpostuser/{id}','App\Http\Controllers\BlogManagementController@edit1')->name('editpost');
Route::GET('{lang}/editpostuser/{id}','App\Http\Controllers\BlogManagementController@edit')->name('editpost');

//Route::POST('/editpostuser','App\Http\Controllers\BlogManagementController@update1')->name('editpost');
Route::POST('/{lang}/editpostuser','App\Http\Controllers\BlogManagementController@update')->name('editpost');

//Route::GET('/deletepostuser/{id}','App\Http\Controllers\BlogManagementController@delete1')->name('deletepost');
Route::GET('{lang}/deletepostuser/{id}','App\Http\Controllers\BlogManagementController@delete')->name('deletepost');


//Route::GET('/viewallbloguser/{id}','App\Http\Controllers\BlogManagementController@viewallbloguser1')->name('viewallblog');
Route::GET('{lang}/viewallbloguser/{id}','App\Http\Controllers\BlogManagementController@viewallbloguser')->name('viewallblog');


Route::GET('/deletecomment/{id}','App\Http\Controllers\BlogCommentsController@delete')->name('deletecomment');
Route::POST('/addcomment','App\Http\Controllers\BlogCommentsController@insert')->name('addcomment');

});
});
});

Route::middleware('2faadmin')->group(function () {
Route::middleware('auth:admin')->group(function () {
Route::middleware('is_admin')->group(function () {




//Route::get('/user_blog','App\Http\Controllers\Admin\BlogManagementController@userblog1')->name('user_blog');
Route::get('/{lang}/user_blog','App\Http\Controllers\Admin\BlogManagementController@userblog')->name('user_blog');


//Route::GET('/editpost/{id}','App\Http\Controllers\Admin\BlogManagementController@editpost1')->name('editpost');
Route::GET('{lang}/editpost/{id}','App\Http\Controllers\Admin\BlogManagementController@editpost')->name('editpost');

//Route::POST('/editpost','App\Http\Controllers\Admin\BlogManagementController@updatepost1')->name('editpost');
Route::POST('{lang}/editpost','App\Http\Controllers\Admin\BlogManagementController@updatepost')->name('editpost');

//Route::GET('/viewallblog/{id}','App\Http\Controllers\Admin\BlogManagementController@viewallblog1')->name('viewallblog');
Route::GET('{lang}/viewallblog/{id}','App\Http\Controllers\Admin\BlogManagementController@viewallblog')->name('viewallblog');

//Route::GET('/deletepost/{id}','App\Http\Controllers\Admin\BlogManagementController@deletepost1')->name('deletepost');
Route::GET('{lang}/deletepost/{id}','App\Http\Controllers\Admin\BlogManagementController@deletepost')->name('deletepost');

//Route::get('/admin_dashboard', 'App\Http\Controllers\Admin\BlogManagementController@index')->name('admin_dashboard');
Route::get('/{lang}/admin_dashboard1', 'App\Http\Controllers\Admin\BlogManagementController@index1')->name('admin_dashboard1');

//Route::get('/cancel','App\Http\Controllers\Admin\BlogManagementController@usermangement1')->name('cancel');


Route::GET('{lang}/edituser/{id}','App\Http\Controllers\Admin\UserManagementController@edituser')->name('edituser');
Route::GET('{lang}/editajax','App\Http\Controllers\Admin\UserManagementController@updateajax')->name('edituser1');
Route::GET('{lang}/addnewuser','App\Http\Controllers\Admin\UserManagementController@add')->name('adduser');
Route::post('{lang}/createnewuser','App\Http\Controllers\Admin\UserManagementController@createnewuser')->name('createnewuser');
Route::POST('{lang}/edituser','App\Http\Controllers\Admin\UserManagementController@update')->name('edituser');
Route::GET('{lang}/deleteuser/{id}','App\Http\Controllers\Admin\UserManagementController@delete')->name('deleteuser');
Route::view('{lang}/passwordchange','admin.usermanagement.passwordchange')->name('passwordchange');
Route::POST('{lang}/changepass','App\Http\Controllers\Admin\UserManagementController@changepass')->name('changepass');
//Route::view('/usermangementajaxview','admin.usermangement')->name('usermangementajaxview');
//Route::get('/usermangementajax','App\Http\Controllers\Admin\UserManagementController@usermangementajax')->name('usermangementajax');
//Route::POST('/searchuserdata','App\Http\Controllers\Admin\UserManagementController@searchuserdata1')->name('searchuserdata');

Route::GET('/{lang}/usermangementajaxviewserverside','App\Http\Controllers\Admin\UserManagementController@index')->name('usermangementajaxviewserverside');


Route::GET('{lang}/cmsmanagement','App\Http\Controllers\Admin\CMSController@cmsmanagement')->name('cmsmanagement');
Route::GET('{lang}/editcms/{id}','App\Http\Controllers\Admin\CMSController@editcms')->name('editcms');
Route::POST('{lang}/editcms','App\Http\Controllers\Admin\CMSController@updatecms')->name('updatecms');

});
});
});
});



//Route::prefix('admin')->group(function () {//prefix routing
Route::name('admin.')->group(function () {//naming routing

    Route::middleware('guest:admin')->group(function () {//group middleware
        Route::get('admin/login','App\Http\Controllers\Admin\Auth\AuthenticatedSessionController@create')->name('login');
        Route::POST('admin/adminlogin','App\Http\Controllers\Admin\Auth\AuthenticatedSessionController@store')->name('adminlogin');

        Route::get('admin/forgot-password','App\Http\Controllers\Admin\Auth\PasswordResetLinkController@create')->name('password.request');
        Route::post('admin/forgot-password','App\Http\Controllers\Admin\Auth\PasswordResetLinkController@store')->name('password.email');
        Route::get('admin/reset-password/{token}', 'App\Http\Controllers\Admin\Auth\NewPasswordController@create')->name('password.reset');
        Route::post('admin/reset-password', 'App\Http\Controllers\Admin\Auth\NewPasswordController@store')->name('password.update');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::post('admin/logout', 'App\Http\Controllers\Admin\Auth\AuthenticatedSessionController@destroy')->name('logout');
    });

//});
});


require __DIR__.'/auth.php';
