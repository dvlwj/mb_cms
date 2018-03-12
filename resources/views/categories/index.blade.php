@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li class="active">
                <!-- <a href="{{route('categories.index')}}">Categories</a> -->
                Kategori Produk
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
                Kategori Produk
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-condensed table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Dibuat oleh</th>
                            <th>Diedit oleh</th>
                            <th>Dibuat</th>
                            <th>Diedit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td class="text-justify">{{$category->category_name}}</td>
                            @if($category->creator!=null)
                            <td class="text-center">{{$category->creator->username}}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif
                            @if($category->updater!=null)
                            <td class="text-center">{{$category->updater->username}}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif
                            <td class="text-center">{{date('H:i:s d-m-Y', strtotime($category->created_at))}}</td>
                            <td class="text-center">{{date('H:i:s d-m-Y', strtotime($category->updated_at))}}</td>
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
            <div class="panel-footer footer-fix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{route('categories.create')}}" class="pagination btn btn-primary">
                                <i class="fa fa-fw fa-plus"></i>Tambah Data
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection