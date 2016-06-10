<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Post;
// use App\Comment;
use App\User;
use App\Category;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Session;
use Redirect;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function show($id){
		$post = Post::find($id);
		if(sizeof($post) > 0)
		{
			// increase view by 1 
			// $post ->views_num +=1 ;
			// $post ->save();
			return view ('post.single',compact('post'));
			//return $post;
		}
		else
		{
			Session::put('error',  "this page isnt avalible!!");	
			Redirect::to('/errors/404');
		}
			

	}
	// store new post 
	public function store(Request $request){
		/* set validation of post componants*/
		$validator = Validator::make($request->all(),[
			'content' => 'Required|min:6',

		]);
		if($validator->fails())
		{// validator dosn't work
			Session::put('errors',  $validator->messages());
			return Redirect::back();
		}
		else
		{
			$user = Auth::user();
			$post = new Post;
			$post->content = $request->content;
			$post->created_at = Carbon::now();
			$post->updated_at = Carbon::now();
			$post->user_id = $user->id;
			$post->user_token = $user->token;
			if (Input::hasFile('image') && Input::file('image')->isValid()) 
			{
				$file = Input::file('image');
				$destinationPath = public_path(). '/post_pictures/';
				$extension = Input::file('image')->getClientOriginalExtension();
				$filename = $post->created_at.'.'.$extension;
				$post->image = '/post_pictures/'.$filename;
				Input::file('image')->move($destinationPath, $filename);
				Image::make($destinationPath.$filename)->insert(public_path().'/images/logo.png','bottom-right')->resize(900, 400)->save($destinationPath.$filename);

				$post->save();
				$user->personal->no_posts +=1;
				$user->personal->save();
			    Session::put('done',  'post add succssufully');
				return Redirect::back();
			}
			else 
			{
			      // sending back with error message.
				$post->save();
				$user->personal->no_posts +=1;
				$user->personal->save();
				Session::put('done',  'post add succssufully');
				return Redirect::back();
			}
		}//end of valid validator
	}// end of store action

	public function append($post_id,Request $request){
		$post = Post::find($post_id);
		if (Auth::user() && Auth::user()->id == $post->user_id && Auth::user()->token == $post->user_token)
		{
			if(sizeof($post) > 0)
			{
				$post->content =$request->content;
				$post->updated_at = Carbon::now();
				$post->save();
				// Session::put('done',  'post deleted succssufully..');
				return $post;
			}
			else
			{
				Session::put('error',"something went wrong, please try again after while..");
				Redirect::to('/errors/404');
			}
		}
		else
		{
			Session::put('error',  "You are not authorize to be here, sorry for disapoint you, we are SECUIRE!!!");	
			Redirect::to('/errors/404');
		}
	}//end of destroy action

	public function destroy($id){
		$post = Post::find($id);
		if (Auth::user() && Auth::user()->id == $post->user_id && Auth::user()->token == $post->user_token)
		{
			if(sizeof($post) > 0)
			{
				$post->user->personal->no_posts -=1;
				$post->user->personal->save();
				$post->delete();
				Session::put('done',  'post deleted succssufully..');
				return Redirect::back();
			}
			else
			{
				Session::put('error',"something went wrong, please try again after while..");
				Redirect::to('/errors/404');
			}
		}
		else
		{
			Session::put('error',  "You are not authorize to be here, sorry for disapoint you, we are SECUIRE!!!");	
			Redirect::to('/errors/404');
		}
	}//end of destroy action
}
