<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Post;
use App\Follower;
use App\User;
use App\Comment;
use App\Personal_data;
use View;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $layout = 'layouts.app';
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user()->id;

        $followers = follower::where('user_id',$user)->pluck('follower_id');
        /*get top user with max num of posts*/
        $top_users_to_follow = Personal_data::whereNotIn('user_id', $followers)->where('user_id','!=', $user)->orderBy(DB::raw('no_posts + no_comments +no_commentups+no_postups'),'DESC')->take(4)->get();
        $raw_one = Personal_data::whereNotIn('user_id', $followers)->where('user_id','!=', $user)->orderBy(DB::raw('no_posts + no_comments +no_commentups+no_postups'),'DESC')->take(4)->get()->pluck('user_id');
        // return $raw_one;
        Session::put('top_users_to_follow', $top_users_to_follow);
        /*get top user with max num of floowers */
        $top_interactive_to_follow = Personal_data::whereNotIn('user_id', $followers)->whereNotIn('user_id', $raw_one)->where('user_id','!=', $user)->orderBy('perentage', 'desc')->take(4)->get();
        // ->whereNotIn('user_id', $top_users_to_follow)
        // return $top_interactive_to_follow;
        Session::put('top_interactive_to_follow',$top_interactive_to_follow);
        /*get all user with order num of floowers */
        $top_to_follow = Personal_data::whereNotIn('user_id', $followers)->where('user_id','!=', $user)->orderBy(DB::raw('no_posts + no_comments +no_commentups+no_postups'),'DESC')->get();
        Session::put('top_to_follow', $top_to_follow);
        
        $posts = Post::whereIn('user_id', $followers)->orWhere('user_id',$user)->orderBy('created_at','DESC')->get();
        return view('index',compact('posts'));

    }
    public function search(Request $request)
    {
        
        $users = User::where('email','LIKE', '%' .$request['search'].'%')
        ->orWhere('name','LIKE', '%' .$request['search'].'%')
        ->orWhere('id_number','LIKE', '%' .$request['search'].'%')->get();

        $posts = Post::where('content','LIKE', '%' .$request['search'].'%')
        ->orWhere('created_at','LIKE', '%' .$request['search'].'%')
        ->get();

        $comments = Comment::where('content','LIKE', '%' .$request['search'].'%')
        ->orWhere('created_at','LIKE', '%' .$request['search'].'%')
        ->get();
        return view('search',compact('users','posts','comments'));

    }
}
