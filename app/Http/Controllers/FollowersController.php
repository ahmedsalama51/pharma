<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests;
use App\Follower;
use Carbon\Carbon;
class FollowersController extends Controller
{
    public function store($follower_id,Request $request){
		/* set validation of following componants*/
		// $validator = Validator::make($follower_id,$request->all(),[
		// 	'follower_id' => 'Required',
		// ]);

		if(isset($request->follower_id))
		{
			$user = Auth::user();
			$follower = User::find($request->follower_id);
			$exsist = Follower::where('follower_id',$follower->id)->where('user_id',$user->id)->pluck('id');
			if(sizeof( $exsist)>0)
			{
				return "already followed";
			}
			
			$following = new Follower;
			$following->user_id = $user->id;
			$following->follower_id = $follower->id;
			$following->created_at = Carbon::now();
				$following->save();
				$follower->personal->no_followers +=1;
				$follower->personal->save();
				$done = 'followed succssufully';
				return $exsist;
			    // return Redirect::to('/')->with('done');
		}
		else
		{// validator dosn't work
			return "error";
		}
		
		
	}// end of store action
	public function destroy($follower_id,Request $request){
		$following = Follower::find($request->id);
		if (Auth::user() && Auth::user()->id == $following->user_id)
		{
			if(sizeof($following) > 0)
			{
				$following->follower->personal->no_followers -=1;
				$following->follower->personal->save();
				$following->delete();
				Session::put('done',  'unfollowed done');
				return Redirect::back();
			}
			else
			{
				Session::put('error',"something went wrong, please try again after while..");
				return Redirect::to('/errors/404');
			}
		}
		else
		{
			Session::put('error',  "You are not authorize to do that, sorry for disapoint you, we are SECUIRE!!!");	
			return Redirect::to('/errors/404');
		}
	}//end of destroy action
}
