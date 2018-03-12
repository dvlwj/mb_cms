@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                <i class="fa fa-fw fa-close"></i>
            </a>
            {{$message}}
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" action="{{route('checkorder')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            <div class="col-md-3 col-md-offset-2 text-right">
                                <label class="control-label" for="code">Nomor Pemesanan :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Nomor Pemesanan" autofocus required>
                            </div>
                            <div class="col-md-3">&nbsp;</div>
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
                    <button type="submit" class="btn btn-primary" style="width:100%">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection