<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show category from here
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.category.index',compact('categories'));
    }

    //store category from here
    public function store(Request $request){


         $request->validate([
            'category_name'=>'required|unique:categories|max:255',

        ]);


        Category::insert([
            'category_name'=>$request->category_name,
            'status'=>$request->status,
            'category_slug'=>Str::slug($request->category_name, '-'),
        ]);

        return response()->json('Category Successfully Inserted!');

    }

    //edit category from here
    public function edit($id){

        $data=Category::find($id);
        return view('admin.category.category.edit',compact('data'))->render();
    }

    //update category from here
    public function update(Request $request){
        $validate = $request->validate([
            'category_name'=>'required|max:255',
        ]);

        Category::where('id', $request->id)->update([
            'category_name'=>$request->category_name,
            'status'=>$request->status,
            'category_slug'=>Str::slug($request->category_name, '-'),
        ]);

        return response()->json('Category Successfully Updated!');
    }

    // delete category from here
    public function delete($id){
        Category::where('id',$id)->delete();
        $notification=array('msg' => 'Category Successfully Deleted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

    // global function to get child category id that used for product table
    public function getChildCategory($id){

        $data=Childcategory::where('subcategory_id',$id)->get();
        return response()->json($data);
    }
}
