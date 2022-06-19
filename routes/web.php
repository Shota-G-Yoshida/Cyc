<?php

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

//Route::get('/posts', 'PostController@index');

/*
Route::get('/', function () {
    return view('index');
});
*/
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'PostController@index');
    Route::get('/posts/{post}', 'PostController@show')->where('post', '[0-9]+');
    Route::get('/posts/create', 'PostController@create');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@delete');
    
    
    Route::get('/categories/{category}', 'CategoryController@index');
    
    Route::get('/mypage/{user}', 'MypageController@mypage');
    Route::get('/mypage/{user}/edit', 'MypageController@edit');
    Route::put('/mypage/{user}', 'MypageController@update');
    
    Route::post('/posts/{post}/favorites', 'FavoriteController@store');
    Route::post('/posts/{post}/unfavorites', 'FavoriteController@destroy');
    
    Route::post('/mypage/{user}/follow', 'FollowController@store');
    Route::post('/mypage/{user}/unfollow', 'FollowController@destroy');
    Route::get('/mypage/{user}/FollowUser', 'FollowController@FollowUser');
    Route::get('/mypage/{user}/FollowingUser', 'FollowController@FollowingUser');
    
    Route::get('/routes/search', 'RouteController@search');
    Route::post('/routes/route', 'RouteController@route');
    // Route::get('/routes/search', 'RouteController@route');

    Route::get('/posts/ranking', 'PostController@ranking');
    
    Route::post('/comment', 'CommentsController@store');
    
    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

?>