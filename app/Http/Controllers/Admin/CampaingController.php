<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Campaing;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class CampaingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // brand show from here
    public function index(Request $request){

        if($request->ajax()){
            $data = Campaing::all();

            return DataTables::of($data)
            ->addIndexColumn()

            ->editColumn('status',function($row){
                if($row->status== 1 ){
                    return '<a href="javascript:void(0)" class="status" data-id="'.$row->id.'"  data-status="'.$row->status.'" ><i class="bx bxs-bell text-success"></i></a>';
                }else{
                    return '<a href="javascript:void(0)" class="status" data-id="'.$row->id.'"  data-status="'.$row->status.'" ><i class="bx bxs-bell-off bx-flip-horizontal text-danger"></i> </a>';
                }
            })
            ->addColumn('action', function($row){
                $actionbtn=' <a href="" data-bs-toggle="modal" class="update" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a href="javascript:void(0)" id="delete" data-id="'.$row->id.'"><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action','status'])->make(true);
        }
        return view('admin.campaing.index');
    }

      // store brand from here

      public function store(Request $request){


        $request->validate([
            'campaing_title'=>'required',
            'status'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);

        $slug = Str::slug($request->campaing_title, '-');
        $photo=$request->images;
        $photoName=uniqid().'.'.$photo->getClientOriginalExtension();
        $photo_path=$photo->move('files/campaing/',$photoName);
        //Image::make($photo)->resize(240,120)->save('files/brand/',$photoName);

       Campaing::insert([
                 'campaing_title'=>$request->campaing_title,
                 'campaing_description'=>$request->campaing_description,
                 'campaing_slug'=>$slug,
                 'discount'=>$request->discount,
                 'status'=>$request->status,
                 'start_date'=>$request->start_date,
                 'end_date'=>$request->end_date,
                 'year'=>date('Y'),
                 'month'=>date('F'),
                 'images'=>$photo_path,

        ]);


        return response()->json([
            'message' => 'Campaing Successfully Inserted!',
           'images' => 'files/campaing/' . $photoName
        ], 200);
      }

       //edit from here
    public function edit($id){
        $data=Campaing::find($id);

       return view('admin.campaing.edit',compact('data'))->render();


    }

     // delete brand from here
     public function delete($id){
        $getImg=Campaing::where('id',$id)->first();
        unlink($getImg->images);
        Campaing::where('id',$id)->delete();

        return response()->json([
            'message' => 'Campaing Successfully Deleted!',
        ], 200);


    }

    // update campaing from here
    public function update(Request $request){

        $request->validate([
            'campaing_title'=>'required',
            'status'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        $photoName = 0;
        $slug = Str::slug($request->campaing_title, '-');
        if($request->images != 0){
            unlink($request->old_images);
            $photo=$request->images;
            $photoName=uniqid().'.'.$photo->getClientOriginalExtension();
            $photo_path=$photo->move('files/campaing/',$photoName);
            //Image::make($photo)->resize(240,120)->save('files/brand/',$photoName);
        }else{

            $photo_path=$request->old_images;
        }


       Campaing::where('id', $request->id)->update([
                 'campaing_title'=>$request->campaing_title,
                 'campaing_description'=>$request->campaing_description,
                 'campaing_slug'=>$slug,
                 'discount'=>$request->discount,
                 'status'=>$request->status,
                 'start_date'=>$request->start_date,
                 'end_date'=>$request->end_date,
                 'year'=>date('Y'),
                 'month'=>date('F'),
                 'images'=>$photo_path,

        ]);


        return response()->json([
            'message' => 'Campaing Successfully Updated!',
           'images' => 'files/campaing/' . $photoName
        ], 200);

    }

     // status disable from here
     public function status($id, Request $request)
     {
        Campaing::where('id',$id)->update(['status' => $request->status == 1 ? 0 : 1]);

         return response()->json([
             'status' => 'success'
         ]);
     }


}
