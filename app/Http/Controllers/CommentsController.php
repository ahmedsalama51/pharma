<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use Session;
use Redirect;
use Illuminate\Support\Facades\Validator;


class CommentsController extends Controller
{
    public function store($post_id,Request $request){
		/* set validation of following componants*/
		$validator = Validator::make($request->all(),[
			'content' => 'Required|min:6',
		]);

		if($validator->fails())
		{// validator dosn't work
			return $validator->messages();
			
		}
		else
		{
			if(Auth::user()->id)
			{
				$user = Auth::user();
				$post = Post::find($post_id);
			}
			else
				return Redirect::to('/auth/login');
			$comment = new Comment;
			$comment->user_id = $user->id;
			$comment->post_id = $post_id;
			$comment->content = $request->content;
			$comment->created_at = Carbon::now();
			$comment->save();
			$comment->count = Post::find($post_id)->comments->count();
			/*add the interavtive values*/
			$user->personal->no_comments +=1; // currunt user num of comment increase
			$user->personal->save();
			$post->user->personal->no_interactions +=1; // post owner interactives increase
			$post->user->personal->perentage =
					$post->user->personal->no_interactions / ($post->user->personal->no_posts + $post->user->personal->no_comments);
			$post->user->personal->save();
			// $done = 'commentd succssufully';
			$comment->count = $comment->post->comments->count();
			return $comment;
			    // return Redirect::to('/')->with('done');
		}
	}// end of store action


	public function append($comment_id,Request $request){
		$comment = Comment::find($comment_id);
		if (Auth::user() && Auth::user()->id == $comment->user_id)
		{
			if(sizeof($comment) > 0)
			{
				$comment->content =$request->content;
				$comment->updated_at = Carbon::now();
				$comment->save();
				// Session::put('done',  'comment deleted succssufully..');
				return $comment;
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
		$comment = comment::find($id);
		if (Auth::user() && Auth::user()->id == $comment->user_id)
		{
			if(sizeof($comment) > 0)
			{
				$comment->user->personal->no_comments -=1;
				$comment->user->personal->save();
				$comment->delete();
				$comment->user->personal->no_interactions -=1;
				$comment->user->personal->perentage =
					$comment->user->personal->no_interactions / ($comment->user->personal->no_posts + $comment->user->personal->no_comments);
				$comment->user->personal->save();
				Session::put('done',  'comment deleted succssufully..');
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
