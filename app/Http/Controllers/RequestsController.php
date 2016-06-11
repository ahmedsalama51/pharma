<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Account;

use Redirect;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class RequestsController extends Controller
{
     public function store(Request $request)
    {

    	$validator = Validator::make($request->all(),[
			'name' => array( 'required', 'alpha_dash', 'max:200' ),
			'email' => array( 'required', 'email', 'min:6', 'max:200' ),

		]);
		if($validator->fails())
		{// validator dosn't work
			$errors = $validator->messages();
			return Redirect::to('/request')->with('errors');
			// return back()->with('errors');
			
		}
		else{

			$req = new Account;
			$req->name = $request->name;
			$req->email = $request->email;
			$req->id_number = $request->id_number;
			$req->type = $request->type;
			$req->created_at = Carbon::now();
			$req->updated_at = Carbon::now();
	    	if (Input::hasFile('certificate') && Input::file('certificate')->isValid())
	         {
	            $imageName =  '/request/'.time(). '.' . 
	            $request->file('certificate')-> getClientOriginalExtension();
	            $req->certificate = $imageName;
	            $req->save();
	            $request->file('certificate')->move(
	            base_path() . '/public/request/', $imageName );
	         }
	         else
	         {
	         
	            $imageName = "/profilepic/1.png";
	            $req->certificate = $imageName;
	            $req->save();
	         }
	    }
    }
}
