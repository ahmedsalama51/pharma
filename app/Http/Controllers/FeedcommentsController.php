<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feedcomment;
use App\Feedcommentup;
use Auth;
use DB;

class FeedcommentsController extends Controller
{
    public function add(Request $request)
    {
		/* set validation of post componants*/
        $this->validate($request, [
            'content' => 'required|unique:feedcomments|max:255',
        ]);

			$user_id = Auth::user()->id;
			$feedcomment = new Feedcomment;
			$feedcomment->content = $request->content;
			$feedcomment->user_id = $user_id;
			$feedcomment->feedback_id=$request->id;
			$feedcomment->no_ups = "0";
			$feedcomment->save();
			$image = $feedcomment->user->personal->image;
			$uname = $feedcomment->user->name;
			return [$feedcomment,$uname,$image];

	}
	 public function delete($id)
    {
    	$user_id = Auth::user()->id;
    	$comment = Feedcomment::find($id);
    	if($comment->user_id  == $user_id )
    	{
    		$comment->delete();
    		return "ok";
    	}
    	else
    	{
    		return "fail";
    	}
    	
    	return back();

    }

    public function update( Request $request)
    {
    	
    	// return $request;
  		$comment = Feedcomment::find( $request->id);
  		// return $comment;
  		$user_id = Auth::user()->id;
  		if($comment->user_id  == $user_id )
  		{
  			$content = $request->content;
    	
	    	$comment->content = $content;
	    	$comment ->update();
	    	$image = $comment->user->personal->image;
			$uname = $comment->user->name;
	    	return [$comment,$uname,$image];

  		}
  		else
  		{

  		}
    	
    	 
    }

    public function up(Request $request)
	{   

			// return $request->input('comment');
	    $comment_id = $request->input('comment');
	    $user_id = Auth::user()->id;
	   //  // echo "here";
	    
	    $conditions = ['feedcomment_id' => $comment_id, 'user_id' => $user_id];
	    $result = DB::table('feedcommentups')->where($conditions)->first();
	    // return $result;
	    // var_dump($result);
	  	if($result == null)
	  	{
	  		$commentup = new Feedcommentup;
		    $commentup->feedcomment_id=$comment_id;
		    $commentup->user_id=$user_id;
		    $commentup->save();

		   	$comment = Feedcomment::find($comment_id);
		   	$comment->no_ups +=1;
		   	$comment->update();
		    return 1;
	  	}
	  	else
	  	{
	  	
	  		$up =Feedcommentup::where($conditions)->first();
	  		$up->delete();
	  		$comment = Feedcomment::find($comment_id);
		   	$comment->no_ups -=1;
		   	$comment->update();
	  		return 0;
	  	}
	    

	}
}