<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LogController extends Controller
{
    //
    use AuthenticatesUsers;

    public function Login(Request $request){
    	$phone = $request->phone;
    	$password = $request->password;


    	$user = User::where('phone','Like',$phone);
        if(password_verify($password, $user->first()->password) and $phone == $user->first()->phone){
            if($user->first()->user_type == 1){
                auth()->login($user->first(), true);
                return redirect()->route('admin_dashboard');
            }
        }
    }
    public function demo(){
        echo password_hash('admin1234',PASSWORD_DEFAULT);
    }
}
