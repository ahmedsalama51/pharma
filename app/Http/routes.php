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

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

 Route::group(['middleware' => ['web']], function () {


		Route::auth();
		Route::get('/', 'HomeController@index');
		//post routes ...
		Route::get('posts/{post}', 'PostsController@show');
		Route::post('posts/add', 'PostsController@store');
		Route::put('edit/{post}', 'PostsController@append');
		Route::get('delete/{post}', 'PostsController@destroy');
		//user routes ...
		Route::get('/users/index', 'UsersController@index');
		Route::get('/users/{User}', 'UsersController@profile');
		Route::get('/users/{User}/profiledetails', 'UsersController@details');
		Route::get('/users/{User}/editprofile', 'UsersController@edit');
		Route::patch('/users/{User}/update', 'UsersController@update');

        //follow routes ...
        Route::post('/follow/{follower_id}', 'FollowersController@store');
        Route::post('/unfollow/{follower_id}', 'FollowersController@destroy');
		
		//R&D routes ...
		Route::get('features', 'FeaturesController@index');
		Route::get('features/{feature}', 'FeaturesController@feature');
		Route::post('feedbacks/{feature}', 'FeedbacksController@store');
		Route::get('feedbacks/delete/{feature}', 'FeedbacksController@destroy');
		Route::post('feedcomment/{feedback}/add', 'FeedcommentsController@add');
		Route::get('feedcomment/{comment}/delete', 'FeedcommentsController@delete');
		Route::post('feedcomment/edit/{comment}', 'FeedcommentsController@update');
		Route::post('/feedcomment/up','FeedcommentsController@up');
		Route::get('feedbacks/up/{feature}', 'FeedbacksController@feedbackUp');
		Route::get('feedbacks/down/{feature}', 'FeedbacksController@feedbackDown');
		
		//comment routes ...
		Route::post('comment/add/{post}', 'CommentsController@store');
		Route::put('comment/edit/{comment}', 'CommentsController@append');
		Route::get('delete/{comment}', 'CommentsController@destroy');
		//postUP routes ...
		Route::post('/postup/add/{post}', 'PostupsController@store');






 }); 


Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', 'AdminController@index');
    //R&D routes ...
    //url -> /features/add
    Route::post('features/add', 'FeaturesController@add');
    //url -> /features/{{$feature->id}}/delete
	Route::get('features/{feature}/delete', 'FeaturesController@delete');


});
