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
            ->editColumn('heading_one', function($row){
                $heading =substr($row->heading_one,0, 10);
                return $heading .'...';
            })
            ->editColumn('description_one', function($row){
                $description =substr($row->description_one, 0, 15);
                return $description .'...';
            })
            ->editColumn('heading_two', function($row){
                $heading =substr($row->heading_two,0, 10);
                return $heading .'...';
            })
            ->editColumn('description_two', function($row){
                $description =substr($row->description_two, 0, 15);
                return $description .'...';
            })
            ->editColumn('heading_three', function($row){
                $heading =substr($row->heading_three,0, 10);
                return $heading .'...';
            })
            ->editColumn('description_three', function($row){
                $description =substr($row->description_three, 0, 15);
                return $description .'...';
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
            'heading_one'=>'required',
            'description_one'=>'required',
        ]);

        $image_one=$request->image_one;
        $photoName=uniqid().'.'.$image_one->getClientOriginalExtension();
        $img_one_path=$image_one->move('files/pages/',$photoName);


        $image_two=$request->image_two;
        $photoName=uniqid().'.'.$image_two->getClientOriginalExtension();
        $img_two_path=$image_two->move('files/pages/',$photoName);


        $image_three=$request->image_three;
        $photoName=uniqid().'.'.$image_three->getClientOriginalExtension();
        $img_three_path=$image_three->move('files/pages/',$photoName);


        $data = Page::create([
            'page_name'=>$request->page_name,
            'page_title'=>$request->page_title,
            'page_slug'=>Str::slug($request->page_name),
            'heading_one'=>$request->heading_one,
            'description_one'=>$request->description_one,
            'image_one'=>$img_one_path,
            'heading_two'=>$request->heading_two,
            'description_two'=>$request->description_two,
            'image_two'=>$img_two_path,
            'heading_three'=>$request->heading_three,
            'description_three'=>$request->description_three,
            'image_three'=>$img_three_path,

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
            'heading_one'=>'required',
            'description_one'=>'required',
        ]);


        if(!empty($request->image_one)){
            $image_one=$request->image_one;
            $photoName=uniqid().'.'.$image_one->getClientOriginalExtension();
            $img_one_path=$image_one->move('files/pages/',$photoName);
            if(file_exists($request->img_one_old)){
                unlink($request->img_one_old);
            }
        }else{

            $img_one_path=$request->img_one_old;
        }
        if(!empty($request->image_two)){
            $image_two=$request->image_two;
            $photoName=uniqid().'.'.$image_two->getClientOriginalExtension();
            $img_two_path=$image_two->move('files/pages/',$photoName);
            if(file_exists($request->img_two_old)){
                unlink($request->img_two_old);
            }
        }else{

            $img_two_path=$request->img_two_old;
        }
        if(!empty($request->image_three)){
            $image_three=$request->image_three;
            $photoName=uniqid().'.'.$image_three->getClientOriginalExtension();
            $img_three_path=$image_three->move('files/pages/',$photoName);
            if(file_exists($request->img_three_old)){
                unlink($request->img_three_old);
            }
        }else{

            $img_three_path=$request->img_three_old;
        }

        Page::where('id', $request->id)->update([
                'page_name'=>$request->page_name,
               'page_title'=>$request->page_title,
                'page_slug'=>Str::slug($request->page_name, '-'),
              'heading_one'=>$request->heading_one,
          'description_one'=>$request->description_one,
                'image_one'=>$img_one_path,
              'heading_two'=>$request->heading_two,
          'description_two'=>$request->description_two,
                'image_two'=>$img_two_path,
            'heading_three'=>$request->heading_three,
        'description_three'=>$request->description_three,
              'image_three'=>$img_three_path,
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
