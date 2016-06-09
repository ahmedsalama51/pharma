<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// use Request;
use Auth;
use DB;
use App\User;
use App\Post;
use App\Personal_data;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Redirect;

class UsersController extends Controller
{
    public function profile($id ,User $user)
    {
    	// echo $id;
        if($id ==  Auth::user()->id)
        {
            $id = Auth::user()->id;
            $profile = DB::table('personal_datas')->where('id',$id )->first();
            $posts =   Post::where('user_id','=',$id )->orderBy('created_at','DESC')->get();
            // foreach ($posts as $value) {
            //     echo $value['content'];
            // }
            return view('users.profile',compact('profile','posts')); 

        }
        else
        {
            $profile = DB::table('personal_datas')->where('id',$id )->first();
            $user = DB::table('users')->where('id',$profile->user_id )->first();
            $posts = Post::where('user_id','=',$user->id )->orderBy('created_at','DESC')->get();

            return view('users.other',compact('user','profile','posts'));  
        }

     // //    
        
        // $posts = $user-> posts();
        //  $posts = Post::with('user')->get();
        // print_r($posts);
        
            // foreach($user->posts as $post) {
            //     echo $post->content;
            // }
            // return view('users.profile',compact('profile'));  
            // return "Not Empty record"; 
        
        
        // var_dump($profile);
    }

    public function details($id)
    {
       if($id == Auth::user()->id)
       {
            $user_id = Auth::user()->id;
            $profile = DB::table('personal_datas')->where('user_id',$user_id )->first();
            if($profile == null)
            {
                $profile = new Personal_data ;
                $profile->user_id = Auth::user()->id;
                $profile->image = "/profilepic/1.png";
                $profile->save();
                return view('users.details',compact('profile'));  
            }
            else
            {
                return view('users.details',compact('profile'));  
              
            }
       }
       else
       {
            
            $user = DB::table('users')->where('id',$id )->first();
            $profile = DB::table('personal_datas')->where('user_id',$user->id )->first();
            return view('users.otherdetails',compact('user','profile'));  
        
       }
        
        
    }
    public function edit()
    {
    	return view('users.edit');
    }

    public function update(User $user, Request $request)
    {
        $id = Auth::user()->id;
        $currentuser = User::where('id',$id)->first();


        $currentuser->name = $request->uname;
        $currentuser->email = $request->email;
        $currentuser->update();


        $profile = Personal_data::where('user_id','=',$id )->first();
        $profile->first_name = $request->fname;
        $profile->last_name = $request->lname;
        $profile->degree = $request->degree;
        $profile->company = $request->company;
       

         if (Input::hasFile('image'))
         {
            $imageName =  Carbon::now(). '.' . 
            $request->file('image')-> getClientOriginalExtension();
            $profile->image = '/profilepic/'.$imageName;
            $profile->update();
            $request->file('image')->move(
            base_path() . '/public/profilepic/', $imageName );
         }
         else
        {
              $profile->image = $profile->image;
              $profile->update();
        }

         
        
          // var_dump($profile);
          // return redirect('/users/profiledetails');
        return redirect('/users/index/?id='.$id);
          // return Redirect::route('users', 
          //                   array(Auth::user()->id));
    }

    public function index()
    {
        $id = $_GET['id'];
        
        if($id == Auth::user()->id)
       {
            $user_id = Auth::user()->id;
            $profile = DB::table('personal_datas')->where('user_id',$user_id )->first();
            return view('users.details',compact('profile'));  
              
            
       }
       else
       {
            return redirect('/');
       }
    }

}
