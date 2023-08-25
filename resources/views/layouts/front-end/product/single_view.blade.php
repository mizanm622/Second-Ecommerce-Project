<div class="modal-body">

    <div class="card">
        <div class="card-header">

            <div class="product-name">
                <div class="row">
                    <div class="col-6">

                       <img src="{{asset($featuredProduct->brand->brand_logo)}}" alt="" class="img-thumbnail text-center" width="60" height="80" >
                    </div>
                    <div class="col-6">
                        <h3 class="text-left">{{$featuredProduct->name}} </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <div class="logo text-center">
                        <img src="{{asset($featuredProduct->thumbnail)}}" alt="" class="img-thumbnail" width="250" height="300" >
                    </div>
                </div>
                <div class="col-6">
                    <div class="description">

                        <h3>Regular Price: {{$featuredProduct->selling_price}}</h3>
                        <h3 class="text-warning">Offer Price : {{$featuredProduct->discount_price}}</h3>
                        <p>Stack: {{$featuredProduct->stack_quantity}}</p>
                        @if(empty($featuredProduct->size))
                        @else
                        <p>Size: {{$featuredProduct->size}}</p>
                        @endif
                        <p>Color: {{$featuredProduct->color}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
