<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\AuthenticatesUsers;
use App\Http\Requests\registerRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
class RegisterController extends Controller
{
    public function getRegister() {
        //return view('login');
        return view('register');
    }

    public function postRegister(Request $request) {
       $user = User::create(array('name'=>$request->name,'email'=>$request->email,'level'=>1,'password'=>Hash::make($request->password)));
       return view('login');
    }
}
