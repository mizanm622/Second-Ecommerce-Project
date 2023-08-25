<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    //add new user
    public function register(){

        return view('layouts.front-end.user.user_register');
    }
    // create new user from here
    public function create(Request $request){

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);


             User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => Hash::make($request['password']),
            ]);

            $notification=array('msg' => 'Registration Successfully Complated! ', 'alert-type' => 'success');
            return redirect()->to('/')->with($notification);


    }


}
