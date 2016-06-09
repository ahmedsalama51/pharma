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
    public function add(Request $request,$id)
    {
		/* set validation of post componants*/
        $this->validate($request, [
            'content' => 'required|unique:feedcomments|max:255',
        ]);

			$user_id = Auth::user()->id;
			$feedcomment = new Feedcomment;
			$feedcomment->content = $request->content;
			$feedcomment->user_id = $user_id;
			$feedcomment->feedback_id=$id;
			$feedcomment->save();
			return back();

	}
	 public function delete($id)
    {
    	$user_id = Auth::user()->id;
    	$comment = Feedcomment::find($id);
    	if($comment->user_id  == $user_id )
    	{
    		$comment->delete();
    	}
    	else
    	{
    		return back();
    	}
    	
    	return back();

    }

    public function up(Request $request)
	{   
	    $comment_id = $request->input('comment');
	    $user_id = Auth::user()->id;
	    // echo "here";
	    
	    $conditions = ['feedcomment_id' => $comment_id, 'user_id' => $user_id];
	    $result = DB::table('feedcommentups')->where($conditions)->first();
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
		    return back();
	  	}
	  	else
	  	{
	  		return back();
	  	}
	    

	}
}
