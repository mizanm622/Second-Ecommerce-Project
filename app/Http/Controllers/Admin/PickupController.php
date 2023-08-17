<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class PickupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show pickup from here
    public function index(Request $request){

        if($request->ajax()){
            $data = Pickup::all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="'.route('pickup.delete',$row->id).'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action'])->make(true);

        }


        return view('admin.pickup.index');

    }

     // store pickup from here
     public function store(Request $request){

        $validate=$request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone_one'=>'required',
        ]);

        $data = Pickup::insert([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone_one'=>$request->phone_one,
            'phone_two'=>$request->phone_two,

   ]);

//    $notification=array('msg' => 'Pickup Successfully Inserted! ', 'alert-type' => 'success');
//    return redirect()->back()->with($notification);
     return response()->json('Pickup Successfully Inserted!');

    }

     //edit pickup from here
     public function edit($id){
        $data=Pickup::find($id);

       return view('admin.pickup.edit',compact('data'))->render();


    }

     //update pickup from here
     public function update(Request $request){


        $validate=$request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone_one'=>'required',
        ]);

        Pickup::where('id', $request->id)->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone_one'=>$request->phone_one,
            'phone_two'=>$request->phone_two,
        ]);

        $notification=array('msg' => 'Pickup Successfully Updeted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

    // delete pickup from here
  public function delete($id){

    Pickup::where('id',$id)->delete();

  $notification=array('msg' => 'Pickup Successfully Deleted! ', 'alert-type' => 'warning');
  return redirect()->back()->with($notification);

}


}
