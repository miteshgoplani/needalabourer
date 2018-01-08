<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;//to bring in the User model (line 26)
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//this is a constructor which is activated when the class is called which will ask for authentication before displaying posts
        {
        $this->middleware('auth');
        }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user_id= auth()->user()->id;//user_id will have the id of the logged in user
        $user = User::find($user_id);   //using 'User' model we have to find the user_id
        return view('dashboard')->with('posts',$user->posts);//$user->posts will show the posts of the specific user that has logged in since they have been already linked
    }
}
