<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Feedback;
use App\Feedbackup;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Redirect;
use Illuminate\Support\Facades\Validator;
class FeedbacksController extends Controller
{

	 
	public function store(Request $request,$id){
        $this->validate($request, [
            'content' => 'required',
        ]);

			$user = Auth::user();
			$exsist = Feedback::where('feature_id',$id)->where('user_id',$user->id)->pluck('id');
			if(sizeof( $exsist)>0)
			{
				#return Redirect::back()->with('error','you have already added your feedback');
				return Redirect::back()->withErrors(['msg', 'you have already added your feedback']);
			}
			$feedback = new Feedback;
			$feedback->content = $request->content;
			$feedback->user_id = $user->id;
			$feedback->feature_id=$id;
			$feedback->save();
			return Redirect::back();

	}

	public function feedbackUp(Request $r , $id){
		$user = Auth::user();
		#$feature_id = $r->feature_id;
		$feedback = Feedback::where('id',$id)->where('user_id',$user->id)->pluck('user_id');
	/*	$feedback = Feedback::where('id',$id)->pluck('id');
		$feedback_owner=$feedback->user_id;*/
		$exsist = Feedbackup::where('feedback_id',$id)->where('user_id',$user->id)->pluck('id');
		if(sizeof( $exsist)>0 || sizeof( $feedback)>0)
		{
				#return Redirect::back()->with('error','you have already added your feedback');
			return Redirect::back()->withErrors(['msg', 'you have already added your feedback']);
		}
		
	    $up = new Feedbackup;
	    $up->feedback_id=$id;
	    $up->user_id = $user->id;
	    $up->save();
	    return Redirect::back();
	}
}

