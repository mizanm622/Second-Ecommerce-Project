<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
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

    public function seo()
    {

        $data = Seo::first();

        return view('admin.setting.seo', compact('data'));
    }

    public function seoUpdate(Request $request, $id)
    {

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
    public function smtp()
    {
        $data=Smtp::first();

        return view('admin.setting.smtp',compact('data'));
    }

    //smtp update from here
    public function smtpUpdate(Request $request, $id)
    {

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
    public function website()
    {
         $data=Setting::first();

         return view('admin.setting.website', compact('data'));
    }

    //update website setting from here
    public function wedsiteUpdate(Request $request, $id)
    {

                // dd($request->old_favicon);

            if(!empty($request->logo)){
                $logo=$request->logo;
                $photoName=uniqid().'.'.$logo->getClientOriginalExtension();
                $logo_path=$logo->move('files/setting/',$photoName);
                if(file_exists($request->old_logo)){
                    unlink($request->old_logo);
                }
            }else{

                $logo_path=$request->old_logo;
            }
            if(!empty($request->favicon)){
                $favicon=$request->favicon;
                 $photoName=uniqid().'.'.$favicon->getClientOriginalExtension();
                 $favi_path=$favicon->move('files/setting/',$photoName);
                 if(file_exists($request->old_favicon)){
                    unlink($request->old_favicon);
                }
                }
                else{
                 $favi_path=$request->old_favicon;
            }




        Setting::where('id',$id)->update([
            'website_name'=>$request->website_name,
            'currency_name'=>$request->currency_name,
            'currency'=>$request->currency,
            'phone_one'=>$request->phone_one,
            'phone_two'=>$request->phone_two,
            'main_email'=>$request->main_email,
            'support_email'=>$request->support_email,
            'address'=>$request->address,
            'town'=>$request->town,
            'city'=>$request->city,
            'country'=>$request->country,
            'zip'=>$request->zip,
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

    // Payment getway
    public function paymentGateway()
    {
        $data = PaymentGateway::first();
        $surjo = PaymentGateway::skip(1)->first();
        $ssl_commerz = PaymentGateway::skip(2)->first();

        return view('admin.setting.payment_gateway.edit', get_defined_vars());
    }

    // update gateway
    public function paymentGatewayUpdate(Request $request)
    {
        $validate= $request->validate([
                'gateway_name'=>'required',
                'store_id'=>'required',
                'signature_key'=>'required',
                'status'=>'required',

        ]);

        if($request->id == 1){
            PaymentGateway::where('id',$request->id)->update([
                'gateway_name'=>$request->gateway_name,
                'store_id'=>$request->store_id,
                'signature_key'=>$request->signature_key,
                'status'=>$request->status,
            ]);

            return response()->json('AAMER Pay Successfully Updated');
        }elseif($request->id == 2){
            PaymentGateway::where('id',$request->id)->update([
                'gateway_name'=>$request->gateway_name,
                'store_id'=>$request->store_id,
                'signature_key'=>$request->signature_key,
                'status'=>$request->status,
            ]);

            return response()->json('Surjo Pay Successfully Updated');
        }elseif($request->id == 3){
            PaymentGateway::where('id',$request->id)->update([
                'gateway_name'=>$request->gateway_name,
                'store_id'=>$request->store_id,
                'signature_key'=>$request->signature_key,
                'status'=>$request->status,
            ]);

            return response()->json('SSL Commerz Pay Successfully Updated');
        }

    }

}
