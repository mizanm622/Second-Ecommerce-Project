<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // admin after login
    public function admin(){
        return view('admin.home');
    }

    //admin register here
    public function adminRegister(){
        return view('admin.profile.admin_register');
    }

    //create new admin
    public  function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


         User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('admin.home');
    }
     // admin after logout
    public function logout(){
        Auth::logout();
        $notification=array('msg' => 'You are successfully loged out! ', 'alert-type' => 'success');

        return redirect()->route('admin.login')->with($notification);
    }

    //reset admin password
    public function changePasswrd(){
        return view('admin.profile.change_password');
    }

    // update password reom here
    public function updatePasswrd(Request $request){

        $validate= $request->validate([
            'old_password'=>'required',
            'password'=>'required|min:6'
        ]);


        if(Hash::check($request->old_password, Auth::user()->password)){
            User::where('id',Auth::id())->update([
                'password'=>Hash::make($request->password)

            ]);

            Auth::logout();
            $notification=array('msg' => 'Password Successfully Updated! ', 'alert-type' => 'success');
            return redirect()->route('admin.login')->with($notification);

        }else{
            $notification=array('msg' => 'Old Password Does not Match!', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }


    }
}
