@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="message">
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                <i class="fa fa-fw fa-close"></i>
            </a>
            <div class="text-center">
                <h2>Pemesanan Sukses !</h2>
                {{--  <p>
                    PESANAN ANDA AKAN SEGERA KAMI PROSES
                </p>  --}}
                <p>
                    <h2>KODE PESANAN ANDA :</h2>
                </p>
                <div class="container" style="border: 1px solid #336699;padding: 1em;margin-top: 2em; margin-bottom: 2em;width: 50%">
                    <h1 id="responsemessage" class="text-capitalize" style="font-weight: bold;"></h1>
                </div>
                <p>*Jangan lupa untuk mencatat kode pesanan anda untuk memeriksa status pesanan anda</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    if (localStorage.getItem('kode_pesanan')) {
//   var msg = $('#message')
        var responsemessage = document.getElementById('responsemessage')
        responsemessage.innerHTML = localStorage.getItem('kode_pesanan')
        localStorage.removeItem('kode_pesanan')
    }
</script>
@endsection