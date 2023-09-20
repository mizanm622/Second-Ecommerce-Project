<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Pickup;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // get all items from here
    public function index(){
        $categories=Category::all();
        $brands=Brand::all();
        $pickups=Pickup::all();
        $warehouses=Warehouse::all();





        return view('admin.product.index', compact('categories','brands','pickups','warehouses'));
    }

    //show product from here
    public function show(Request $request){


        if($request->ajax()){



            $product=" ";

            $data = DB::table('products')
            ->leftJoin('categories', 'products.category_id','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
            ->leftJoin('brands', 'products.brand_id','brands.id')
            ->leftJoin('warehouses', 'products.warehouse_id','warehouses.id');

            if($request->category_id){
                $data->where('products.category_id', $request->category_id);
            }
            if($request->subcategory_id){
                $data->where('products.subcategory_id', $request->subcategory_id);
            }
            if($request->brand_id){
                $data->where('products.brand_id', $request->brand_id);
            }

            if($request->warehouse_id){
                $data->where('products.warehouse_id', $request->warehouse_id);
            }


            $product=$data->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name','warehouses.warehouse_name')
            ->get();




            return DataTables::of($product)
            ->addIndexColumn()
            ->editColumn('featured',function($row){
                if($row->featured == 1){
                    return '<a href="javascript:void(0)" class="featured" data-id="'.$row->id.'"  data-featured="'.$row->featured.'" ><i class="bx bxs-bell text-success"></i></a>';
                }else{
                    return '<a href="javascript:void(0)" class="featured" data-id="'.$row->id.'"  data-featured="'.$row->featured.'" ><i class="bx bxs-bell-off bx-flip-horizontal text-danger"></i> </a>';
                }
            })
            ->editColumn('status',function($row){
                if($row->status == 1 ){
                    return '<a href="javascript:void(0)" class="status" data-id="'.$row->id.'"  data-status="'.$row->status.'" ><i class="bx bxs-bell text-success"></i></a>';
                }else{
                    return '<a href="javascript:void(0)" class="status" data-id="'.$row->id.'"  data-status="'.$row->status.'" ><i class="bx bxs-bell-off bx-flip-horizontal text-danger"></i> </a>';
                }
            })
            ->editColumn('thumbnail',function($row){   // thumb image show from here
                return "<img src='"."/".$row->thumbnail."' width='30' >";
            })


            ->addColumn('action', function($row){
                $actionbtn=' <a href="'.route('product.edit',$row->id).'" class="update"> <i class="bx bx-edit"></i></a>|<a href="" data-bs-toggle="modal" class="edit" data-id="'.$row->id.'" data-bs-target="#updateModal"> <i class="bx bx-show"></i></a>| <a id="delete"  data-id="'.$row->id.'" href="" ><i class="bx bx-trash" ></i></a> ';
                return $actionbtn;
            })
            ->rawColumns(['action','category_name','subcategory_name','brand_name','warehouse_name','thumbnail','status','featured'])->make(true);

        }


        $categories=Category::all();
        $subcategories=Subcategory::all();
        $brands=Brand::all();
        $pickups=Pickup::all();
        $warehouses=Warehouse::all();

        return view('admin.product.show', compact('categories','subcategories','brands','pickups','warehouses'));





    }

    // store product from here

    public function store(Request $request){

       $cat_id=Subcategory::where('id',$request->subcategory_id)->first();


        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'subcategory_id'=>'required',
            'childcategory_id'=>'required',
            'stack_quantity'=>'required',
            'purches_price'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'image'=>'required',
            'tags'=>'required',
            'description'=>'required',
        ]);
            //image upload
            $photo=$request->image;
            $photoName=uniqid().'.'.$photo->getClientOriginalExtension();
            $photo_path=$photo->move('files/product/images/',$photoName);
             //thumbnail upload
            $thumb=$request->thumbnail;
            $thumbName=uniqid().'.'.$thumb->getClientOriginalExtension();
            $thumb_path=$thumb->move('files/product/thumbs/',$thumbName);




               //$request->filled('status') ? 1 : 0;



        Product::insert([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name,'-'),
            'code'=>$request->code,
            'category_id'=>$cat_id->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'childcategory_id'=>$request->childcategory_id,
            'brand_id'=>$request->brand_id,
            'pickup_id'=>$request->pickup_id,
            'color'=>$request->color,
            'size'=>$request->size,
            'unit'=>$request->unit,
            'video'=>$request->video,
            'warehouse_id'=>$request->warehouse_id,
            'thumbnail'=>$thumb_path,
            'featured'=>$request->featured,
            'is_new'=>$request->is_new,
            'trending'=>$request->trending,
            'product_slider'=>$request->product_slider,
            'todays_deal'=>$request->todays_deal,
            'status'=>$request->status,
            'flash_deal_id'=>$request->flash_deal_id,
            'admin_id'=>auth()->id(),
            'cash_on_delivery'=>$request->cash_on_delivery,
            'stack_quantity'=>$request->stack_quantity,
            'purches_price'=> $request->purches_price,
            'selling_price'=>$request->selling_price,
            'discount_price'=>$request->discount_price,
            'images'=>$photo_path,
            'tags'=>$request->tags,
            'description'=>$request->description,

        ]);

        $notification=array('msg' => 'Product Successfully Inserted! ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    // edit product from here

    public function edit($id){

        $products=Product::where('id',$id)->first();
        $categories=Category::all();
        $brands=Brand::all();
        $warehouses=Warehouse::all();
        $pickups=Pickup::all();

        return view('admin.product.edit', compact('products','categories','brands','pickups','warehouses'));

    }

    // Update product from here
    public function update(Request $request){
        $cat_id=Subcategory::where('id',$request->subcategory_id)->first();


        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'subcategory_id'=>'required',
            'childcategory_id'=>'required',
            'stack_quantity'=>'required',
            'purches_price'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'tags'=>'required',
            'description'=>'required',
        ]);

        if(empty($request->image)){
            $photo_path=$request->old_image;
        }else{
             //image upload
            $photo=$request->image;
            $photoName=uniqid().'.'.$photo->getClientOriginalExtension();
            $photo_path=$photo->move('files/product/images/',$photoName);
            unlink($request->old_image);
        }
        if(empty($request->thumbnail)){
            $thumb_path=$request->old_thumbnail;
        }else{
             //thumbnail upload
             $thumb=$request->thumbnail;
             $thumbName=uniqid().'.'.$thumb->getClientOriginalExtension();
             $thumb_path=$thumb->move('files/product/thumbs/',$thumbName);
             unlink($request->old_thumbnail);
            }

            Product::where('id',$request->id)->update([
                'name'=>$request->name,
                'slug'=>Str::slug($request->name,'-'),
                'code'=>$request->code,
                'category_id'=>$cat_id->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'childcategory_id'=>$request->childcategory_id,
                'brand_id'=>$request->brand_id,
                'pickup_id'=>$request->pickup_id,
                'color'=>$request->color,
                'size'=>$request->size,
                'unit'=>$request->unit,
                'video'=>$request->video,
                'warehouse_id'=>$request->warehouse_id,
                'thumbnail'=>$thumb_path,
                'featured'=>$request->featured,
                'trending'=>$request->trending,
                'is_new'=>$request->is_new,
                'product_slider'=>$request->product_slider,
                'todays_deal'=>$request->todays_deal,
                'status'=>$request->status,
                'flash_deal_id'=>$request->flash_deal_id,
                'admin_id'=>auth()->id(),
                'cash_on_delivery'=>$request->cash_on_delivery,
                'stack_quantity'=>$request->stack_quantity,
                'purches_price'=> $request->purches_price,
                'selling_price'=>$request->selling_price,
                'discount_price'=>$request->discount_price,
                'images'=>$photo_path,
                'tags'=>$request->tags,
                'description'=>$request->description,

            ]);


            $notification=array('msg' => 'Product Successfully Updated! ', 'alert-type' => 'success');
            return redirect()->route('product.show')->with($notification);


    }


    // view single product from here

    public function view($id){

        $data=Product::find($id);

       return view('admin.product.view',compact('data'))->render();


    }

    // status disable from here
    public function status($id, Request $request)
    {
        Product::where('id',$id)->update(['status' => $request->status == 1 ? 0 : 1]);

        return response()->json([
            'status' => 'success'
        ]);
    }


    // featured disable from here
    public function featured($id, Request $request)
    {
        Product::where('id',$id)->update(['featured' => $request->featured == 1 ? 0 : 1]);

        return response()->json([
            'featured' => 'success'
        ]);
    }

    public function delete($id){
        $getImg=Product::where('id',$id)->first();
        unlink($getImg->images);
        unlink($getImg->thumbnail);
        Product::where('id',$id)->delete();

        return response()->json('Product Successfully Deleted!');

    }
}
