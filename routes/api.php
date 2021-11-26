<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testApi;
use App\Http\Controllers\USerController;
use GuzzleHttp\Middleware;

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

//return
// Route::get('data',[testApi::class,'getData']);


// get list
Route::get('device',[testApi::class,'device']);
//get spefic id
Route::get('device/{id}',[testApi::class,'deviceId']);
// get specfic id if not list
Route::get('deviceoption/{id?}',[testApi::class,'deviceOption']);
//search with get
Route::get('search-device/{string}',[testApi::class,'searchDevice']);


//post
Route::post('add-device',[testApi::class,'addDevice']);
//post validate data
Route::post('validate-device',[testApi::class,'testDevice']);
//upload
Route::post('upload',[testApi::class,'upload']);



//put(update)
Route::put('update-device',[testApi::class,'updateDevice']);


//delete
Route::delete('delete-device/{id}',[testApi::class,'deleteDevice']);



//Authenticated api routes
//santum login
Route::post('login',[USerController::class,'index']);

Route::group(['middleware'=>('auth:sanctum')],function(){
    //All secure routes go here 
    Route::get('data',[testApi::class,'getData']);
    
});