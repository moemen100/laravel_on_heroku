<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware'=>['web']],function()
{Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', ['uses'=>'usercontroller@getdashboard','as'=>'dashboard','middleware'=>'auth']
);
Route::post('/signup',['uses'=>'usercontroller@postSignUp','as'=>'signup']);

Route::post('/signin',['uses'=>'usercontroller@postSignIn','as'=>'signin']);
});