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
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
/*$count = App\Flight::where('active', 1)->count();

$max = App\Flight::where('active', 1)->max('price');*/
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
    public function login(Request $request){
        
         $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        if (\Auth::attempt(['id_number' => $request->email, 'password' => $request->password])) {
          if(\Auth::user()->isAdmin()){

                return redirect('/admin');
            }
            else{
            return redirect('/');
            }
        } 

        elseif (\Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {

            if(\Auth::user()->isAdmin()){

                return redirect('/admin');
            }
            else{   
            return redirect('/'); 
            }
        } 

        else{
            return redirect('/login')
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
        }
    }


}
