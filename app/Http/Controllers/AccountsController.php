<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Account;

use Redirect;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class AccountsController extends Controller
{
     public function store(Request $request)
    {

	    	if ($request->isMethod('post')){
    		$validator = Validator::make($request->all(),[
					'name' => array( 'required', 'alpha_dash', 'max:200' ),
					'email' => array( 'required', 'email','unique:users', 'unique:accounts', 'min:6', 'max:200' ),
					'id_number' => array( 'unique:users', 'unique:accounts')
	
			]);
			if($validator->fails())
			{// validator dosn't work
				$errors= $validator->messages();
				return view('auth.register',compact('errors'));
				// return back()->with('errors');
				
			}
			else{

				$account = new Account;
				$account->name = $request->name;
				$account->email = $request->email;
				$account->id_number = $request->id_number;
				$account->created_at = Carbon::now();
				$account->updated_at = Carbon::now();
		    	if (Input::hasFile('certificate') && Input::file('certificate')->isValid())
		         {
		            $imageName =  Carbon::now(). '.' . 
		            $request->file('certificate')-> getClientOriginalExtension();
		            $account->certificate = '/request/'.$imageName;
		            $account->save();
		            $request->file('certificate')->move(
		            base_path() . '/public/request/', $imageName );
		         }
		         else
		         {
		         
		            $imageName = "/profilepic/1.png";
		            $account->certificate = $imageName;
		            $account->save();
		         }
		         $message = 'Your Request Has Been Sent Successfully !';
		         return view('auth.register',compact('message'));
		    }
		}
	    return view('auth.register');
    }

    public function requests()
    {
    	$requests = Account::where('is_active','0')->get();
        return view('requests.index', compact('requests'));
    }

    public function rejected()
    {
    	$requests = Account::where('is_active','1')->get();
        return view('requests.rejected', compact('requests'));
    }

    public function accepted()
    {
    	$requests = Account::onlyTrashed()->get();
    	return view('requests.accepted', compact('requests'));
    }

    public function accept($id='')
    {
    	if($id!=''){
    		$request = Account::findOrFail($id);
    		if (!$request->trashed()) {
    			if ($request->is_active == '0') {
    				return view('requests.generate', compact('request'));
    			}
    		}	
    	}
    	return back();
    }

    public function reject($id='')
    {
    	if($id!=''){
    		$request = Account::findOrFail($id);
    		$request->is_active = 1;
    		if($request->update())
    			$message = 'The Request Has Been Rejected Succesfully';
    		else
    			$message = 'The Request Has not been Rejected ' ;
    		$requests = Account::where('is_active','1')->get();
            return view('requests.rejected', compact('requests','message'));
    	}
    }

    public function unreject($id='')
    {
        if($id!=''){
            $request = Account::findOrFail($id);
            $request->is_active = 0;
            if($request->update())
                $message = 'The Request Has Been Unrejected Succesfully';
            else
                $message = 'The Request Has not been Unejected ' ;
            $requests = Account::where('is_active','1')->get();
            return view('requests.rejected', compact('requests'));
        }
    }
}
