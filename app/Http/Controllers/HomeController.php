<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    
    public function index() {
        //return redirect()->route('product.list');
        if (Auth::check())
        	return redirect()->route('product.list');
        return view('login');
    }

    public function notfound() {
    	return view('404');
    }

  
}
