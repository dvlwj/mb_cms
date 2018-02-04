@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li class="active">
                Produk
            </li>
        </ol>
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
            {{$message}}
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Produk
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-condensed table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Lebar</th>
                            <th>Tinggi</th>
                            <th>Berat</th>
                            <th>Unit Satuan</th>
                            <th>Di Buat oleh</th>
                            <th>Di Perbarui oleh</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Update</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($products as $product)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td class="text-justify">{{$product->category_id}}</td>
                            <td class="text-center">{{$product->product_code}}</td>
                            <td class="text-center">{{$product->product_name}}</td>
                            <td class="text-center">{{$product->description}}</td>
                            <td class="text-center">{{$product->price}}</td>
                            <td class="text-center">{{$product->width}}</td>
                            <td class="text-center">{{$product->height}}</td>
                            <td class="text-center">{{$product->weight}}</td>
                            <td class="text-center">{{$product->unit}}</td>
                            @if(isset($user) && !is_null($user))
                            <td class="text-center">{{$product->creator->username}}</td>
                            <td class="text-center">{{$product->updater->username}}</td>
                            @else
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            @endif
                            <td class="text-center">{{date('H:i:s d-m-Y', strtotime($product->created_at))}}</td>
                            <td class="text-center">{{date('H:i:s d-m-Y', strtotime($product->updated_at))}}</td>
                            <td class="text-center">{{$product->picture}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-faw fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer footer-fix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{route('products.create')}}" class="pagination btn btn-primary">
                                <i class="fa fa-fw fa-plus"></i>Tambah Data
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection