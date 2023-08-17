<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\Smtp;
use Illuminate\Http\Request;
use Intervention\Image;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function seo(){

        $data = Seo::first();

        return view('admin.setting.seo', compact('data'));
    }

    public function seoUpdate(Request $request, $id){

        Seo::where('id',$id)->update([
            'meta_title'=>$request->meta_title,
            'meta_author'=>$request->meta_author,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,
            'meta_keyword'=>$request->meta_keyword,
            'google_verification'=>$request->google_verification,
            'google_analytics'=>$request->google_analytics,
            'google_adsence'=>$request->google_adsence,
            'alexa_verification'=>$request->alexa_verification,
        ]);

        $notification=array('msg' => 'Seo Successfully Updated! ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    //smtp show from here
    public function smtp(){
        $data=Smtp::first();

        return view('admin.setting.smtp',compact('data'));
    }

    //smtp update from here
    public function smtpUpdate(Request $request, $id){

        Smtp::where('id',$id)->update([
            'mailer'=>$request->mailer,
            'host'=>$request->host,
            'port'=>$request->port,
            'user_name'=>$request->user_name,
            'password'=>$request->password,

        ]);

        $notification=array('msg' => 'SMTP Successfully Updated! ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    //website setting from here
    public function website(){
         $data=Setting::first();

         return view('admin.setting.website', compact('data'));
    }

    //update website setting from here
    public function wedsiteUpdate(Request $request, $id){


            if(!empty($request->logo)){
                unlink($request->old_logo);


                $logo=$request->logo;
                $photoName=uniqid().'.'.$logo->getClientOriginalExtension();
                $logo_path=$logo->move('files/setting/',$photoName);

            }else{

                $logo_path=$request->old_logo;
            }


            if(!empty($request->favicon)){
                 unlink($request->old_favicon);
                 $favicon=$request->favicon;
                 $photoName=uniqid().'.'.$favicon->getClientOriginalExtension();
                 $favi_path=$favicon->move('files/setting/',$photoName);
                }
                else{
                    $favi_path=$request->old_favicon;
                }




        Setting::where('id',$id)->update([
            'currency'=>$request->currency,
            'phone_one'=>$request->phone_one,
            'phone_two'=>$request->phone_two,
            'main_email'=>$request->main_email,
            'support_email'=>$request->support_email,
            'address'=>$request->address,
            'facebook'=>$request->facebook,
            'youtube'=>$request->youtube,
            'instagram'=>$request->instagram,
            'linkedin'=>$request->linkedin,
            'twitter'=>$request->twitter,
            'logo'=>  $logo_path,
            'favicon'=>$favi_path,

        ]);

        $notification=array('msg' => 'Website Settings Successfully Updated! ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
}
