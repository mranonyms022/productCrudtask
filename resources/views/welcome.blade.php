@extends('layouts.app')
@section('content')
<div class="container p-3">
    <div class="row">
        <?php $data = \App\Models\Product::all(); ?>
        @if($data->isEmpty())
        <h1 class="text-center">No Products found Please login and Add</h1>
        @else
        @foreach ( $data as $product)
        <div class="card col-lg-3 col-md-3 col-sm-12 ml-2 mr-2">
        <img src="{{asset('products_image')}}/{{$product->image}}" class="card-img-top" alt="..." height="300px" width="100px">
        <div class="card-body">
            <h5 class="card-title">{{$product->product_name}}</h5>
            <p class="card-text">{{$product->description}}</p>
            <p class="card-text"><b class="text-primary text-bold">Price&nbsp;</b>Rs. {{$product->price}}</p>
            <a href="#" class="btn btn-primary">Buy Now</a>
        </div>
        </div>

        @endforeach
    </div>
    @endif
</div>

@endsection

