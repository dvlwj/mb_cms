@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            ABCD
            <h1>{{$transaction->header->purchase_order_code}}</h1>
            <h1>{{$transaction->header->status}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{--  <img src="../images/lazyload.svg" class="lazyload img-responsive" data-src="..{{Storage::url('assets/uploads/').$products->picture}}" alt="{{$products->name}}">  --}}
            {{--  {{$products->price}}  --}}
        </div>
        <div class="col-md-8">
            @if ($transaction->detail)
                <div class="row">
                    <div class="col-md-4">Product ID</div>
                    <div class="col-md-4">Name</div>
                    <div class="col-md-4">Amount</div>
                </div>
                @foreach ($transaction->detail as $detail)
                <div class="row">
                    <div class="col-md-4">{{$detail->product_id}}</div>
                    <div class="col-md-4">{{$detail->product_name}}</div>
                    <div class="col-md-4">{{$detail->amount}}</div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection