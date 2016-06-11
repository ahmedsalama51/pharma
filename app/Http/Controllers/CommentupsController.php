<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Comment;
use App\Commentup;
use Carbon\Carbon;
use Session;
use Redirect;
use Illuminate\Support\Facades\Validator;

class CommentupsController extends Controller
{
    public function store($comment_id,Request $request){
		/* set validation of following componants*/
			$result = array();
			if(Auth::user()->id)
			{
				$user = Auth::user();
				$comment = Comment::find($comment_id);
				$commentups = $user->commentups;
			}
			else
			{
				return Redirect::to('/auth/login');
			}
			
			foreach ($commentups as $key => $commentup)
			{
	           if($commentup['comment_id'] == $comment->id)
				{
					$commentup->delete();
					$comment->user->personal->no_interactions -=1; // comment owner interactives decrease
					$comment->user->personal->save();
					$result['like'] = "duplicate";
					$result['count'] = $comment->commentups->count();
					return $result;
				}

	        } 
			$commentup = new Commentup;
			$commentup->user_id = $user->id;
			$commentup->comment_id = $comment_id;
			$commentup->created_at = Carbon::now();
			$commentup->save();
			/*add the interavtive values*/
			$user->personal->no_commentups +=1; // currunt user num of comment increase
			$user->personal->save();

			$comment->user->personal->no_interactions +=1; // comment owner interactives +
			$comment->user->personal->perentage = $comment->user->personal->no_interactions / ($comment->user->personal->no_comments + $comment->user->personal->no_posts);
			$comment->user->personal->save();
			// $done = 'commentd succssufully';
			$result['like'] = "liked";
			$result['count'] = $comment->commentups->count();
			return $result;
	}// end of store action
}
