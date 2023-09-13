<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

            $mail = session()->get('mail');
            $mail= $request->email;

             User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => Hash::make($request['password']),
            ]);

            session()->put('mail',$mail);
            $user = User::where('email', $mail)->first();
            Shipping::insert([
                'user_id' => $user->id,
                  'phone' => $request->phone,
                'address' => $request->address,
            ]);

            session()->flush();

            $notification=array('msg' => 'Registration Successfully Complated! ', 'alert-type' => 'success');
            return redirect()->to('/')->with($notification);


    }

    // change user password
    public function changePassword(Request $request){

        $validator = Validator ::make($request->all(), [
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      if ($validator->fails()) {
         return response()->json('Please Input Valid Password!');
      }

      if(auth()->attempt(array('email'=>auth()->user()->email,'password'=>$request->old_password))){
        User::where('id', auth()->id())->update([
            'password'=>Hash::make($request->password)
        ]);
        return response()->json('Password Successfully Updated!');
      }else{
            return response()->json('Old Password not Matched!');
        }
      }

      //store user default shipping info
      public function updateShippingAddress(Request $request){

        $validator=Validator::make($request->all(),[
            'phone' => 'required',
          'address' => 'required',
        ]);


        Shipping::where('user_id',auth()->id())->update([
            'user_id' => auth()->id(),
              'phone' => $request->phone,
               'town' => $request->town,
               'city' => $request->city,
                'zip' => $request->zip,
            'address' => $request->address,
            'country' => $request->country,
        ]);

        return response()->json('Successfully Updated!');

      }

    // user profile
    public function userProfile(){

        $user = User::all();
        $wishlist = Wishlist::where('user_id',auth()->id())->latest()->get();
        $shippingInfo = Shipping::where('user_id',auth()->id())->first();

        return view('layouts.front-end.user.user_profile',compact('user','wishlist','shippingInfo'));
    }


}
