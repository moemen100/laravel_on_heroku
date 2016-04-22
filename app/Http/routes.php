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
Route::get('/dashboard', ['uses'=>'PostController@getdashboard','as'=>'dashboard','middleware'=>'auth']);
Route::post('/signup',['uses'=>'usercontroller@postSignUp','as'=>'signup']);
Route::post('/signin',['uses'=>'usercontroller@postSignIn','as'=>'signin']);
    Route::get('/signout',['uses'=>'usercontroller@postSignOut','as'=>'signout']);
    Route::post('/createpost', ['uses' => 'PostController@postCreatePost', 'as' => 'post.create','middleware'=>'auth']);
    Route::get('/deletepost/{post_id}',['uses'=>'PostController@getDeletePost','as' => 'post.delete','middleware' => 'auth']);
    Route::post('/edit', [
        'uses' => 'PostController@postEditPost',
        'as' => 'edit'
    ]);
    Route::post('/like', [
        'uses' => 'PostController@postLikePost',
        'as' => 'like'
    ]);
    
});