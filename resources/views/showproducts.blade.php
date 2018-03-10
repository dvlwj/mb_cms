@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li>
                    <a class="defaulta" style="cursor: default">{{$categories->category_name}}</a>
                </li>
                <li>
                    <a class="defaulta">{{$products->product_name}}</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <img src="../images/lazyload.svg" class="lazyload img-responsive" data-src="..{{Storage::url('assets/uploads/').$products->picture}}" alt="{{$products->name}}">
            </div>
            <div class="col-md-8" style="font-size: 15px">
                <div class="row">
                    <div class="col-md-3"><h4>Kode Produk</h4></div>
                    <div class="col-md-1"><h4>:</h4></div>
                    <div class="col-md-8"><h4>{{$products->product_code}}</h4></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><h4>Lebar</h4></div>
                    <div class="col-md-1"><h4>:</h4></div>
                    <div class="col-md-8"><h4>{{$products->width}} cm</h4></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><h4>Tinggi</h4></div>
                    <div class="col-md-1"><h4>:</h4></div>
                    <div class="col-md-8"><h4>{{$products->height}} cm</h4></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><h4>Berat</h4></div>
                    <div class="col-md-1"><h4>:</h4></div>
                    <div class="col-md-8"><h4>{{$products->weight}} gram</h4></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><h4>Satuan</h4></div>
                    <div class="col-md-1"><h4>:</h4></div>
                    <div class="col-md-8"><h4>1 {{$products->unit}}</h4></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h4>Rp {{$products->price}},00</h4>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <h4>Deskripsi</h4>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body" style="min-height: 200px; overflow: auto;">
                            <p>{{$products->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="well well-kembali" onclick="window.history.back();">
        <div class="text-center"><h4><i class="fa fa-fw fa-chevron-left"></i>Kembali</h4></div>
    </div>
</div>
@endsection