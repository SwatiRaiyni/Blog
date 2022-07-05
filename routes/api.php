<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::GET("{lang}/userpost",'App\Http\Controllers\Api\ApiBlogController@userpost')->name('userpost');

Route::GET("{lang}/search",'App\Http\Controllers\Api\ApiBlogController@index')->name('search');//
Route::GET('{lang}/viewallblog1/{id}','App\Http\Controllers\Api\ApiBlogController@viewallblog')->name('viewallblog');

Route::POST('/addcomment/{post_id}','App\Http\Controllers\Api\ApiCommentController@store')->name('addcomment');

Route::GET('{lang}/cms/{slug}','App\Http\Controllers\Api\ApiCMSController@cms')->name('aboutcms');
// Route::GET('/termsandconditioncms','App\Http\Controllers\Api\ApiCMSController@termsandconditioncms')->name('termsandconditioncms');
// Route::GET('/privacycms','App\Http\Controllers\Api\ApiCMSController@privacycms')->name('privacycms');
// Route::GET('/howitworkcms','App\Http\Controllers\Api\ApiCMSController@howitworkcms')->name('howitworkcms');
// Route::GET('/contactcms','App\Http\Controllers\Api\ApiCMSController@contactcms')->name('contactcms');

