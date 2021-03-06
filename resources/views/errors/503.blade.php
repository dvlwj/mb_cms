@section('title', 'Error')
@section('message', 'Sorry, we are having a temporary problem. We have been alerted and will be rolling out a fix soon')
@extends('layouts.error')
@section('content')
<div class="main">
    <div class="container-fluid page-text text-center">
        <div class="row">
            <div class="col-md-12">
                <h1 class="rotate"><strong>O</strong>ops!, Error 503!</h1>
                <h3>Terlalu banyak pengguna mengakses halaman kami saat ini.</h3>
                <h3>Tunggu beberapa saat sebelum mengakses kembali halaman kami.<br>
                    Silahkan kembali ke <a class="home" href="{{url('/')}}">Halaman Utama</a>, atau :</h3>
                <div class="tombolhubungi">
                    <a href="https://www.facebook.com/cvmegabaut" class="btn btn-danger btn-lg">
                        <i class="fa fa-fw fa-envelope"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>