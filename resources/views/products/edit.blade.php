@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li>
                <a href="{{route('products.index')}}">Produk</a>
            </li>
            <li class="active">Edit Data</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                    {{ Session::get('message') }}
                </div>
                @endif
                Edit Produk
            </div>
            <form class="form-horizontal" action="{{ route('products.update',$products->id) }}" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="category_id">Nama Kategori :</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="product_name">Nama Produk :</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{$products->product_name}}" placeholder="Nama Produk" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="price">Harga :</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="price" name="price" value="{{$products->price}}" placeholder="Harga Produk (Rp)" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('width') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="width">Lebar :</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="width" name="width" value="{{$products->width}}" placeholder="Lebar Produk (cm)" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="height">Tinggi :</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="height" name="height" value="{{$products->height}}" placeholder="Tinggi Produk (cm)" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="weight">Berat :</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="weight" name="weight" value="{{$products->weight}}" placeholder="Berat Produk (gram)" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('unit') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="unit">Satuan :</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{$products->unit}}" placeholder="Unit Satuan (Cth: kardus, pcs, plastik, etc)" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('product_code') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="product_code">Kode Produk :</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="product_code" name="product_code" value="{{$products->product_code}}" placeholder="Kode Produk" autofocus required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="picture">Gambar :</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="picture" name="picture" accept="image/*" value="{{$products->picture}}" placeholder="Gambar Produk">
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="control-label col-md-5" for="description">Deskripsi :</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Deskripsi Produk" required>{{$products->description}}</textarea>
                                </div>
                            </div>
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
                    <button type="submit" class="btn btn-primary" style="width:100%">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
@endsection