<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        #$this->middleware('admin');
        #$this->middleware($this->adminMiddleware(), ['except' => 'logout']);
    	$this->middleware('auth');
   }
public function index(){
        
        return view('admin.dashboard');
    }
}
