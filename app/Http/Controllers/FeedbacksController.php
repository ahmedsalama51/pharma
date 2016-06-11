<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
use App\Feedback;
use App\Feedbackup;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Redirect;
use Illuminate\Support\Facades\Validator;

class FeedbacksController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function store(Request $request){
        $this->validate($request, [
            'content' => 'required',
        ]);

			$user = Auth::user();
			$id=$request->feature_id;
			$token=$request->_token;
			#check if user add feedback to this feature before 
			$exist = Feedback::where('feature_id',$id)->where('user_id',$user->id)->pluck('id');
			if(sizeof( $exist)>0)
			{
				#return Redirect::back()->with('error','you have already added your feedback');
				#return Redirect::back()->withErrors(['msg', 'you have already added your feedback']);
				return response()->json($exist);
			}
			$feedback = new Feedback;
			$feedback->content = $request->content;
			$feedback->user_id = $user->id;
			$feedback->feature_id=$id;
			$feedback->save();
			$count=$feedback->feedbackups->count();
			#return Redirect::back();
			$response = array(
            'count' => $count,
            'feedback' => $feedback,
            'name'=>$feedback->user->name,
            'image'=>$feedback->user->personal->image,
        );
        return response()->json($response); 
	}



	public function destroy(Request $r)
	{
	    $id=$r->feedback_id;
	    $model = Feedback::findOrFail($id);

	    $model->delete();

	    \Session::flash('flash_message_delete','Model successfully deleted.');

	    return response()->json($id);
	}


	public function feedbackUp(Request $r){
		$user = Auth::user();
		$id=$r->feedback_id;
		#check if this user is the feedback owner
		$feedback = Feedback::where('id',$id)->where('user_id',$user->id)->pluck('user_id');
		#check if this user has upped this feedback before or not
		$exist = Feedbackup::where('feedback_id',$id)->where('user_id',$user->id)->pluck('id');
		if(sizeof( $exist)>0 || sizeof( $feedback)>0)
		{
			#return Redirect::back()->with('error','you have already added your feedback');
			#return Redirect::back()->withErrors(['msg', 'you have already added your feedback']);
/*			$myfeedback = Feedback::where('id',$id )->first();
		    $count=$myfeedback->feedbackups->count();
		    #return $count;
		    $response = array(
	            'count' => $count,
	            'feedback_id'=>$id,
	        );
	       return response()->json($response);*/

	    #$user = Auth::user();
		$feedback_id=$id;
		$down= Feedbackup::where('feedback_id',$feedback_id)->where('user_id',$user->id)->first();
		$down->delete(); 
	    $myfeedback = Feedback::where('id',$feedback_id)->first();
	    $count=$myfeedback->feedbackups->count();
	    #return $count;
	    #return Redirect::back();
	    $response = array(
            'count' => $count,
            'feedback_id'=>$feedback_id,
        );
       return response()->json($response);
		}
		
	    $up = new Feedbackup;
	    $up->feedback_id=$id;
	    $up->user_id = $user->id;
	    $up->save();
	    $myfeedback = Feedback::where('id',$id )->first();
	    $count=$myfeedback->feedbackups->count();
	    #return $count;
	    $response = array(
            'count' => $count,
            'feedback_id'=>$id,
        );
       return response()->json($response); 
	    #return view('features.feature',compact('feature','feedbacks'));
	    #return $id;
	}

	public function feedbackDown(Request $r){
		$user = Auth::user();
		$feedback_id=$r->feedback_id;
		$down= Feedbackup::where('feedback_id',$feedback_id)->where('user_id',$user->id)->first();
		$down->delete(); 
	    $myfeedback = Feedback::where('id',$feedback_id)->first();
	    $count=$myfeedback->feedbackups->count();
	    #return $count;
	    #return Redirect::back();
	    $response = array(
            'count' => $count,
            'feedback_id'=>$feedback_id,
        );
       return response()->json($response);

	}
}
