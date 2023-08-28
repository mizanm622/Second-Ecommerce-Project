<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // retrive data from here
    public function index(){

        $subcategories = DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.category_name')->get();

        $categories = Category::all();

        return view('admin.category.subcategory.index',compact('categories','subcategories'));
    }

    // store subcategory from here
    public function store(Request $request){

        $validate = $request->validate([
            'subcategory_name' => 'required|unique:subcategories|max:255',
            'subcategory_logo' => 'required',
        ]);

        $photo=$request->subcategory_logo;
        $photoName=uniqid().'.'.$photo->getClientOriginalExtension();
        $photo_path=$photo->move('files/subcategory/',$photoName);

       $data = Subcategory::insert([
                 'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_logo'=>$photo_path,
            'status'=>$request->status,
            'subcategory_slug'=>Str::slug($request->subcategory_name, '-'),
        ]);



        return response()->json([
            'message' => 'Subcategory Successfully Inserted!',
           'subcategory_logo' => 'files/subcategory/' . $photoName
        ], 200);

    }

    // edit subcategory from here

    public function edit($id){
        $data=Subcategory::find($id);
        $categories=Category::all();
       // $datas=Category::all();

       // return response()->json($data);


       return view('admin.category.subcategory.edit',compact('data','categories'))->render();


    }

     //update category from here
     public function update(Request $request){

        $validate = $request->validate([
            'subcategory_name'=>'required|max:255'
        ]);

        $photoName = 0;
        if($request->subcategory_logo != '0'){
            //unlink($request->old_images);
            $photo=$request->subcategory_logo;
            $photoName=uniqid().'.'.$photo->getClientOriginalExtension();
            $photo_path=$photo->move('files/subcategory/',$photoName);
            //Image::make($photo)->resize(240,120)->save('files/brand/',$photoName);
        }else{

            $photo_path=$request->old_images;
        }
        Subcategory::where('id', $request->id)->update([
                 'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_logo'=>$photo_path,
            'status'=>$request->status,
            'subcategory_slug'=>Str::slug($request->subcategory_name, '-'),
        ]);

        return response()->json([
            'message' => 'Subcategory Successfully Updated!',
           'subcategory_logo' => 'files/subcategory/' . $photoName
        ], 200);
    }

    // delete subcategory from here
    public function delete($id){
        Subcategory::where('id',$id)->delete();
        $notification=array('msg' => 'Pickup Successfully Deleted! ', 'alert-type' => 'warning');
        return redirect()->back()->with($notification);
    }

}
