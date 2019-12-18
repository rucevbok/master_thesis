<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
  

protected function authenticated(Request $request, $user)
{   
    
    
    if (strcmp($user->role,'admin')==0) 
    {
        return redirect()->route('vytvorit_uz');
    }
    else if(strcmp($user->role,'projmanazer')==0) 
    {
        return redirect()->route('proj');
    }
    else if(strcmp($user->role,'user')==0) 
    {
        return redirect()->route('proj');
    }
      return redirect()->route('proj');
    
}
    
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
