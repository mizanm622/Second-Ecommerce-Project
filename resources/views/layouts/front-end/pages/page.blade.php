@extends('layouts.app')

@section('home-content')


<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-hea">
                <h3 class="text-center h3">{{$pages->page_title}}</h3>
            </div>
            <div class="card-body">
                <pre><p>{{$pages->page_description}}</p></pre>
            </div>
        </div>
    </div>
</div>
@endsection
