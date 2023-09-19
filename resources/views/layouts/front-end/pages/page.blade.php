@extends('layouts.app')

@section('home-content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center h3">{{$pages->page_title}}</h3>
                </div>
                <div class="card-body">

                    <ul class="list-unstyled">
                        <li class="media col-12">
                            <img src="{{asset($pages->image_one)}}" alt="{{$pages->image_one}}"  width="550" height="350">
                            <div class="media-body pl-4 pt-5">
                                <div class="title pt-3">
                                    <h3 class="mt-0 mb-1 pt-3">{{$pages->heading_one}}</h3>
                                </div>
                                <div class="description">
                                    <p class="text-justify-center">{{$pages->description_one}}</p>
                                </div>
                            </div>
                        </li>
                        <li class="media col-12">
                            <img src="{{asset($pages->image_two)}}" alt="{{$pages->image_two}}"  width="550" height="350">
                            <div class="media-body pl-4 pt-5">
                                <div class="title pt-3">
                                    <h3 class="mt-0 mb-1 pt-3">{{$pages->heading_two}}</h3>
                                </div>
                                <div class="description">
                                    <p class="text-justify-center">{{$pages->description_two}}</p>
                                </div>
                            </div>
                        </li>
                        <li class="media col-12">
                            <img src="{{asset($pages->image_three)}}" alt="{{$pages->image_three}}" width="550" height="350">
                            <div class="media-body pl-4 pt-5">
                                <div class="title pt-3">
                                    <h3 class="mt-0 mb-1 pt-3">{{$pages->heading_three}}</h3>
                                </div>
                                <div class="description">
                                    <p class="text-justify-center">{{$pages->description_three}}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
