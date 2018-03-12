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
    </div>
    <div class="row" style="margin-bottom:1em;">
        <div class="col-md-12">
            <form autocomplete="off" class="form-horizontal" role="search" action="{{route('welcomesearch')}}">
                <div class="input-group input-group-lg">
                    <input name="searchtext" placeholder="Cari Produk" class="form-control" type="text" id="searchtext">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" id="SearchButton">
                            <span class="fa fa-fw fa-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        @if ($categories != null)
                        @foreach ($categories as $category)
                        <li><a data-toggle="pill" href="#kategori{{$category->id}}">{{$category->category_name}}</a></li>
                        @endforeach
                        @else
                        <p>Data Kategori Kosong</p>
                        @endif
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        @if ($products != null)
                        @foreach ($categories as $category)
                        <div id="kategori{{$category->id}}" class="tab-pane fade">
                            <div class="row">
                            @foreach($products as $product)
                            @if($product->category_id == $category->id)
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <div class="card center-block">
                                        <a href="{{ route('showproducts', $product->id) }}">
                                            <img src="images/lazyload.svg" class="lazyload" data-src=".{{Storage::url('assets/uploads/').$product->picture}}" alt="{{$product->name}}">
                                            <div class="container-fluid">
                                                <h4>{{$product->product_name}}</h4>
                                                <p>Rp {{$product->price}},00</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>Data Produk Kosong</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        activaTab('kategori1');
    });

    function activaTab(tab){
        $('.nav-pills a[href="#' + tab + '"]').tab('show');
    };
</script>
@endsection