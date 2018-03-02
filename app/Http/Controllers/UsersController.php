<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\AuthenticatesUsers;
use App\Http\Models\UsersQModel;
use App\Http\Models\UsersModel;
use App\Http\Requests;
use App\Http\Requests\registerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
class UsersController extends Controller {

    public function index() {
        $users = UsersModel::get_users_by_userid(Auth::user()->id);
        $data = [
            'users' => $users
        ];

        return view('users.list')->with($data);
    }

    public function create() {
        return view('users.insert');
    }

    public function store(registerRequest $request) {
        if (User::create(array('name'=>$request->name,'email'=>$request->email,'level'=>$request->level,'password'=>Hash::make($request->password)))) {
            $request->session()->flash('alert-success',"Thành công");
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger',"Thất bại");
            return redirect()->back();
        }
        
    }

    public function edit($id) {
        $user = User::find($id);
        return view('users.edit',compact('user'));

    }

    public function update($id , Request $request) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        if ($user['password'] != $request->password) {
            $user->password = Hash::make($request->password);
        }
       
        $user->save();
        $request->session()->flash('alert-success',"Thành công");
        return redirect()->route('users.list');
    }

}