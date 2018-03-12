@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li>
                <a href="{{route('categories.index')}}">Categories</a>
            </li>
            <li class="active">Tambah Data</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                    {{ Session::get('message') }}
                </div>
                @endif
                Tambah Kategori Produk
            </div>
            <form class="form-horizontal" action="{{ route('categories.store') }}" method="post">
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="category_name">Nama Kategori :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="category_name" placeholder="Nama Kategori" required autofocus>
                        </div>
                        <!-- @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif -->
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
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fa fa-fw fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
@endsection