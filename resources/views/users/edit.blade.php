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
                Edit User
            </div>
            <form class="form-horizontal" action="{{ route('users.update',$users->id) }}" method="post">
                <div class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="name">Nama :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" placeholder="Nama User" disabled>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="username">Username :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username" value="{{ $users->username }}" placeholder="Username User" disabled>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('userlevel') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="userlevel">Userlevel :</label>
                        <div class="col-md-6">                            
                            <select class="form-control" id="userlevel" name="userlevel" autofocus required>
                                    <option value="1" {{ old('userlevel', $users->userlevel) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ old('userlevel', $users->userlevel) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="email">Email :</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email"  value="{{ $users->email }}" placeholder="Email User" disabled>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2" for="password">Password :(on maintenance)</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password" value="{{ $users->password }}" placeholder="Password User" required>
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