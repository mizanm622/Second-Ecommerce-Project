<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;



class ChildcategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // childcategory data show  using yjra data table from here
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('childcategories')->leftJoin('categories', 'childcategories.category_id', 'categories.id')->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="'.route('delete.childcategory',$row->id).'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action'])->make(true);

        }

        $categories=Category::all();
        return view('admin.category.childcategory.index',compact('categories'));

    }

    // store child category from here
    public function store(Request $request){

      $cat_id=Subcategory::where('id',$request->subcategory_id)->first();
      $validate = $request->validate([
        'childcategory_name'=>'required|unique:childcategories|max:255'
    ]);

   $data = Childcategory::insert([
             'category_id'=>$cat_id->category_id,
             'subcategory_id'=>$request->subcategory_id,
        'childcategory_name'=>$request->childcategory_name,
        'childcategory_slug'=>Str::slug($request->childcategory_name, '-'),

    ]);

    $notification=array('msg' => 'Childcategory Successfully Inserted! ', 'alert-type' => 'success');
    return redirect()->back()->with($notification);


    }
     // edit Childcategory from here

     public function edit($id){
        $data=Childcategory::find($id);
        $categories=Category::all();

       return view('admin.category.childcategory.edit',compact('data','categories'))->render();


    }

     //update category from here
     public function update(Request $request){
        $validate = $request->validate([
            'childcategory_name'=>'required|unique:childcategories|max:255'
        ]);

        $cat_id=Subcategory::where('id',$request->subcategory_id)->first();

        Childcategory::where('id', $request->id)->update([
                 'category_id'=>$cat_id->category_id,
                 'subcategory_id'=>$request->subcategory_id,
            'childcategory_name'=>$request->childcategory_name,
            'childcategory_slug'=>Str::slug($request->childcategory_name, '-'),
        ]);

        $notification=array('msg' => 'Childcategory Successfully Updeted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

     // delete child category from here
     public function delete($id){
        Childcategory::where('id',$id)->delete();
        $notification=array('msg' => 'Childcategory Successfully Deleted! ', 'alert-type' => 'warning');
        return redirect()->back()->with($notification);
    }
}
