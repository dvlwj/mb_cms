@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="message">
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                <i class="fa fa-fw fa-close"></i>
            </a>
            <div class="text-center">
                <p>
                    ANDA TELAH SUKSES MEMESAN BARANG
                </p>
                <p>
                    PESANAN ANDA AKAN SEGERA KAMI PROSES
                </p>
                <p>
                    <b>KODE PESANAN ANDA :</b>
                </p>
                <p id="responsemessage" class="text-capitalize" style="font-weight: bold;font-size: 2em;"></p>
                <p>Jangan lupa untuk mencatat kode pesanan anda untuk memeriksa status pesanan anda</p>
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