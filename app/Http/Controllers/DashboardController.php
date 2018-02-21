<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;//to bring in the User model (line 26)
use App\lab;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//this is a constructor which is activated when the class is called which will ask for authentication before displaying posts
        {
        $this->middleware(['auth','2fa']);
        }
    /**
     * Show the application dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user_id= auth()->user()->id;//user_id will have the id of the logged in user
        $user = User::find($user_id);   //using 'User' model we have to find the user_id
        $labs = lab::all();
        $data = array(
            'posts'=>$user->posts,
            'labs'=>$labs
        );
        return view('dashboard')->with($data);//$user->posts will show the posts of the specific user that has logged in since they have been already linked
    }


    //google2fa
    public function reauthenticate(Request $request)
    {
        // get the logged in user
        $user = \Auth::user();

        // initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // generate a new secret key for the user
        $user->google2fa_secret = $google2fa->generateSecretKey();

        // save the user
        $user->save();

        // generate the QR image
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        // Pass the QR barcode image to our view.
        return view('google2fa.register', ['QR_Image' => $QR_Image, 
                                            'secret' => $user->google2fa_secret,
                                            'reauthenticating' => true
                                        ]);
    }
}

