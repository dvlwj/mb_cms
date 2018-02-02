@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li class="active">
                <!-- <a href="{{route('categories.index')}}">Categories</a> -->
                Kategori Produk
            </li>
        </ol>
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-dismissable">
            {{$message}}
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Kategori Produk
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-condensed table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Di Buat</th>
                            <th>Di Perbarui</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td class="text-justify">{{$category->category_name}}</td>
                            <td class="text-center">{{$category->created_by}}</td>
                            <td class="text-center">{{$category->updated_by}}</td>
                            <td class="text-center">{{$category->created_at}}</td>
                            <td class="text-center">{{$category->updated_at}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-faw fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('categories.create')}}" class="btn btn-primary">
                            <i class="fa fa-fw fa-plus"></i>Tambah Data
                        </a>
                    </div>
                    <div class="col-md-6">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection