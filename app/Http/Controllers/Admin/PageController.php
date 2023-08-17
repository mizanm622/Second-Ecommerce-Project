<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class PageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if($request->ajax()){
            $data = Page::all();



            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="'.route('page.delete',$row->id).'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action'])->make(true);

        }


        return view('admin.setting.page.index');
    }
     // store page from here
    public function store(Request $request){

        $validate=$request->validate([
            'page_name'=>'required',
            'page_title'=>'required',
            'page_position'=>'required',
        ]);

        $data = Page::insert([
            'page_name'=>$request->page_name,
            'page_title'=>$request->page_title,
            'page_position'=>$request->page_position,
            'page_slug'=>Str::slug($request->page_name),
            'page_description'=>$request->page_description,

   ]);

   $notification=array('msg' => 'Page Successfully Inserted! ', 'alert-type' => 'success');
   return redirect()->back()->with($notification);



    }

     //edit from here
     public function edit($id){
        $data=Page::find($id);

       return view('admin.setting.page.edit',compact('data'))->render();


    }

     //update Page from here
     public function update(Request $request){


        $validate = $request->validate([
            'page_name'=>'required|max:255',
            'page_title'=>'required',
            'page_description'=>'required',
            'page_position'=>'required',
        ]);


        Page::where('id', $request->id)->update([
                 'page_name'=>$request->page_name,
                 'page_title'=>$request->page_title,
                 'page_position'=>$request->page_position,
            'page_description'=>$request->page_description,
            'page_slug'=>Str::slug($request->page_name, '-'),
        ]);

        $notification=array('msg' => 'Page Successfully Updeted! ', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

  // delete page from here
  public function delete($id){

    Page::where('id',$id)->delete();

  $notification=array('msg' => 'Page Successfully Deleted! ', 'alert-type' => 'warning');
  return redirect()->back()->with($notification);
}


}
