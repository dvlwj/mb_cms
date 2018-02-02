@extends('layouts.login')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        <i class="fa fa-fw fa-key"></i> Login
                    </h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="javascript:void(0);" id="form">
                        <input type="hidden" name="_csrf" id="_csrf" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label for="email" class="control-label">
                                    <i class="fa fa-fw fa-user"></i> Username / Email
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Username / Email" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label for="password" class="control-label">
                                <i class="fa fa-fw fa-keyboard-o"></i> Password
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="fa fa-fw fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/utils.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/auth/login.js') }}"></script>
<script type="text/javascript">
    var ch = new login("{{ route('login') }}", "{{ route('is.logged.in') }}");
        ch.listen();
</script>
@endsection
