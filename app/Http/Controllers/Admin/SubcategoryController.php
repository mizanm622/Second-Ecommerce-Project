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
            'subcategory_name'=>'required|unique:subcategories|max:255'
        ]);

       $data = Subcategory::insert([
                 'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>Str::slug($request->subcategory_name, '-'),
        ]);



        $notification=array('msg' => 'Sub Category Successfully Inserted! ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

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
            'subcategory_name'=>'required|unique:subcategories|max:255'
        ]);

        Subcategory::where('id', $request->id)->update([
                 'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>Str::slug($request->subcategory_name, '-'),
        ]);

        $notification=array('msg' => 'Subcategory Successfully Updeted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

    // delete subcategory from here
    public function delete($id){
        Subcategory::where('id',$id)->delete();
        $notification=array('msg' => 'Sub Category Successfully Deleted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

}
