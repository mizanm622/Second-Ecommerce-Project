<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show coupon from here
    public function index(Request $request){

        if($request->ajax()){
            $data = Coupon::all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="'.route('coupon.delete',$row->id).'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action'])->make(true);

        }


        return view('admin.coupon.index');

    }

    // store warehouse from here
    public function store(Request $request){

        $validate=$request->validate([
            'coupon_type'=>'required',
            'coupon_amount'=>'required',
            'coupon_code'=>'required',
            'valid_date'=>'required',
            'status'=>'required',
        ]);

        $data = Coupon::insert([
            'coupon_type'=>$request->coupon_type,
            'coupon_amount'=>$request->coupon_amount,
            'coupon_code'=>$request->coupon_code,
            'valid_date'=>$request->valid_date,
            'status'=>$request->status,


   ]);

   $notification=array('msg' => 'Coupon Successfully Inserted! ', 'alert-type' => 'success');
   return redirect()->back()->with($notification);


    }
     //edit from here
     public function edit($id){
        $data=Coupon::find($id);

       return view('admin.coupon.edit',compact('data'))->render();


    }

     //update warehouse from here
     public function update(Request $request){


       
        $validate=$request->validate([
            'coupon_type'=>'required',
            'coupon_amount'=>'required',
            'coupon_code'=>'required',
            'valid_date'=>'required',
            'status'=>'required',
        ]);


        Coupon::where('id', $request->id)->update([
            'coupon_type'=>$request->coupon_type,
            'coupon_amount'=>$request->coupon_amount,
            'coupon_code'=>$request->coupon_code,
            'valid_date'=>$request->valid_date,
            'status'=>$request->status,
        ]);

        $notification=array('msg' => 'Coupon Successfully Updeted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

    // delete coupon from here
  public function delete($id){

    Coupon::where('id',$id)->delete();

  $notification=array('msg' => 'Page Successfully Deleted! ', 'alert-type' => 'warning');
  return redirect()->back()->with($notification);
}
}
