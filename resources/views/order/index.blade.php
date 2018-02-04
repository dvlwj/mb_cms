@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                <i class="fa fa-fw fa-close"></i>
            </a>
            {{$message}}
        </div>
        @endif
            <form class="form-horizontal" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" >
                <div class="panel panel-default">
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        <div class="container-fluid">
                            {{--  <div class="col-md-3">
                                <select class="form-control" id="category_id" name="category_id" autofocus>
                                    <option value="{{$category->id}}">
                                        {{$category->category_name}}
                                    </option>
                                </select>
                            </div>  --}}
                            {{--  {{dd($category)}}  --}}
                            @foreach ($categories as $category)
                            <div class="row" style="margin:1em 0;">
                                <div class="center-block">
                                    <div class="col-md-6">
                                        <select class="form-control" id="{{$category->id}}" name="{{$category->id}}/produk" placeholder="{{$category->id}}" required>
                                            <option disabled selected>Pilih {{$category->category_name}}</option>
                                            @foreach ($products as $product)
                                                @if($product->category_id == $category->id)
                                                <option value="{{$product->id}}" required>
                                                    {{$product->product_name}}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" id="{{$category->id}}/price" name="price" placeholder="Harga" disabled>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Jumlah" value="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="price" name="price" placeholder="Total Harga" disabled>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary" style="width:100%">Pesan</button>
                </div>
                </div>
            </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#{{$category->id}}/product').on('change', function(e){
        alert('berubah');
        console.log(e);
        var category_id = e.target.value;
        $.get('json/product?product_id=' + product_id, function(data) {
            console.log(data);
            $('{{$category->id}}/price').empty();
            $.each(data, function(index,subCatObj){
                $('{{$category->id}}/price').append(''+subCatObj.price+'');
            });
        });
    });
</script>
@endsection