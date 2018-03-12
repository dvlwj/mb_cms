@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li>
                <a href="{{route('users.index')}}">User</a>
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
                Tambah User
            </div>
            <form class="form-horizontal" action="{{ route('users.store') }}" method="post">
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('userlevel') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="userlevel">Level Pengguna :</label>
                        <div class="col-md-6">                            
                            <select class="form-control" id="userlevel" name="userlevel" required>
                                    <option value="1">Admin</option>
                                    <option value="2">Pegawai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="name">Nama Pengguna :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama User" autofocus required>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="username">Username :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username User" required>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="email">Email :</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email User" required>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="password">Password :</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password User" required>
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