<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Jenssegers\MongoDB\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    #protected $redirectTo = '/';
    protected $redirectTo = '/admin';
    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        #$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


public function showLoginForm()
{
    if (view()->exists('auth.authenticate')) {
        return view('auth.authenticate');
    }

    return view('admin.auth.login');
}
public function showRegistrationForm()
{
    return view('admin.auth.register');
} 

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => Carbon::now(),
            'password' => bcrypt($data['password']),
        ]);
    }
#overload login of Auth
/*    public function login(Request $request){
        #for admins table
        if (\Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password])) {
          return redirect('/admin');
        }
        elseif (\Auth::guard('admin')->attempt(['name'=> $request->email, 'password' => $request->password])) {
          return redirect('/admin');
        }
        #for users table
        elseif (\Auth::attempt(['id_number' => $request->email, 'password' => $request->password])) {
          if(\Auth::user()->isAdmin()){

                return redirect('/admin');
            }
            return redirect('/');
        } 

        elseif (\Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {

            /*if(\Auth::user()->isAdmin()){

                return redirect('/admin');
            }*/
            return redirect('/'); 
        } 


        else {
                #echo "fail!";
                return redirect('/login')->withErrors([
                'errors' => 'These credentials do not match our records.',
            ]); 
        }
    }*/
}
