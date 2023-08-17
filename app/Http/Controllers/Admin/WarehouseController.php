<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class WarehouseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show warehouse from here
    public function index(Request $request){

        if($request->ajax()){
            $data = Warehouse::all();



            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="'.route('warehouse.delete',$row->id).'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action'])->make(true);

        }


        return view('admin.category.warehouse.index');

    }

     // store warehouse from here
     public function store(Request $request){

        $validate=$request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ]);

        $data = Warehouse::insert([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,


   ]);

   $notification=array('msg' => 'Warehouse Successfully Inserted! ', 'alert-type' => 'success');
   return redirect()->back()->with($notification);

    }

      //edit from here
      public function edit($id){
        $data=Warehouse::find($id);

       return view('admin.category.warehouse.edit',compact('data'))->render();


    }

     //update warehouse from here
     public function update(Request $request){


        $validate=$request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ]);


        Warehouse::where('id', $request->id)->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
        ]);

        $notification=array('msg' => 'Warehouse Successfully Updeted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }



     // delete warehouse from here
  public function delete($id){

    Warehouse::where('id',$id)->delete();

  $notification=array('msg' => 'Warehouse Successfully Deleted! ', 'alert-type' => 'warning');
  return redirect()->back()->with($notification);
}
}
