<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
//use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // brand show from here
    public function index(Request $request){

        if($request->ajax()){
            $data = Brand::all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="'.route('delete.brand',$row->id).'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action'])->make(true);

        }


        return view('admin.category.brand.index');

    }

    // store brand from here

    public function store(Request $request){


      $validate = $request->validate([
          'brand_name'=>'required|unique:brands|max:255'
      ]);

      $slug = Str::slug($request->brand_name, '-');
      $photo=$request->brand_logo;
      $photoName=$slug.'.'.$photo->getClientOriginalExtension();
      $photo_path=$photo->move('files/brand/',$photoName);
      //Image::make($photo)->resize(240,120)->save('files/brand/',$photoName);



     $data = Brand::insert([
               'brand_name'=>$request->brand_name,
               'brand_slug'=>$slug,
               'brand_logo'=>$photo_path,

      ]);

      $notification=array('msg' => 'Brand Successfully Inserted! ', 'alert-type' => 'success');
      return redirect()->back()->with($notification);
    }

    //edit from here
    public function edit($id){
        $data=Brand::find($id);

       return view('admin.category.brand.edit',compact('data'))->render();


    }

    //update Brand from here
    public function update(Request $request){


        // $validate = $request->validate([
        //     'brand_name'=>'required|unique:brands|max:255'
        // ]);


        // delete previous logo from directory

       // unlink($request->old_logo);

        $slug = Str::slug($request->brand_name, '-');
        if($request->brand_logo){
            if(!empty($request->old_logo)){
                unlink($request->old_logo);
            }

            $photo=$request->brand_logo;
            $photoName=$slug.'.'.$photo->getClientOriginalExtension();
            $photo_path=$photo->move('files/brand/',$photoName);
            Brand::where('id', $request->id)->update([
                     'brand_name'=>$request->brand_name,
                     'brand_slug'=>$slug,
                     'brand_logo'=>$photo_path,
            ]);
            $notification=array('msg' => 'Brand Successfully Updeted! ', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }else{
            $photo=$request->old_logo;
            Brand::where('id', $request->id)->update([
                     'brand_name'=>$request->brand_name,
                     'brand_slug'=>$slug,
                     'brand_logo'=>$photo,

            ]);
            $notification=array('msg' => 'Brand Successfully Updeted! ', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }



    }

    // delete brand from here
    public function delete($id){
        $getImg=Brand::where('id',$id)->first();
        unlink($getImg->brand_logo);
        Brand::where('id',$id)->delete();

      $notification=array('msg' => 'Brand Successfully Deleted! ', 'alert-type' => 'warning');
      return redirect()->back()->with($notification);
    }



}
