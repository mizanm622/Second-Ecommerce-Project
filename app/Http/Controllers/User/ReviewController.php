<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class ReviewController extends Controller
{
    // view review from here
    public function index(){



    }
    // store user reivew data
    public function store(Request $request){


        $request->validate([
          'review_name' => 'required',
        'review_rating' => 'required',
        ]);


      Review::create([
           'product_id' => $request->product_id,
              'user_id' => auth()->id(),
          'review_name' => $request->review_name,
        'review_rating' => $request->review_rating,
          'review_date' => date("j, F Y"),
        ]);

        //
       return response()->json('Thanks for your review! ');

        // $notification=array('msg' => 'Thanks for your review! ', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);

    }
}
