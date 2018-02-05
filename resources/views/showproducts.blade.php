@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$products->product_name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="../images/lazyload.svg" class="lazyload img-responsive" data-src="..{{Storage::url('assets/uploads/').$products->picture}}" alt="{{$products->name}}">
            {{$products->price}}
        </div>
        <div class="col-md-8">
            {{$products->product_code}}
            {{$products->width}}
            {{$products->height}}
            {{$products->weight}}
            {{$products->unit}}
            {{$products->description}}
        </div>
    </div>
</div>
@endsection