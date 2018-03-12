@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h1>Rincian Pesanan</h1>
            </div>
            <div class="col-md-6 text-right">
                <h1>{{$transaction->header->purchase_order_code}}/{{$transaction->header->status}}</h1>
            </div>
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        </div>
    </div>
    <div class="container-fuid">
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="buyer_name">Nama Pembeli :</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$transaction->header->buyer_name}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="buyer_phone">Nomor Telepon :</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$transaction->header->buyer_phone}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="buyer_address">Alamat :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="{{$transaction->header->buyer_address}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="center-block text-center" style="margin: 2em 0;font-weight: bold;">
                            <div class="col-md-6">
                                <p>Produk</p>
                            </div>
                            <div class="col-md-2">
                                <p>Harga</p>
                            </div>
                            <div class="col-md-1">
                                <p>Jumlah</p>
                            </div>
                            <div class="col-md-3">
                                <p>Total Harga</p>
                            </div>
                        </div>
                    </div>
                    @if ($transaction->detail)
                        @foreach ($transaction->detail as $detail)
                            <div class="row">
                                <div class="center-block" style="margin: 1em 0;">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{$detail->product_name}}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control jumlah text-center" id="{{$detail->id}}/price" name="harga" value="{{$detail->price}}" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control harga text-center" id="{{$detail->id}}/amount" name="jumlah" value="{{$detail->amount}}" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control totalprice text-center" id="{{$detail->id}}/totalprice" name="{{$detail->id}}/totalprice" placeholder="Total Harga" value="{{$detail->price*$detail->amount}}" name="total_harga" readonly>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="center-block">
                            <div class="col-md-12" style="margin: 1em 0;">
                                
                                <input type="number" class="form-control" id="totalbill" name="totalbill" placeholder="Total Harga Pesanan" disabled="">
                                {{--  <input type="number" class="form-control" id="totalbill" name="totalbill" placeholder="Total Harga Pesanan" disabled>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        var jumlah = document.getElementsByClassName('jumlah')
        var harga = document.getElementsByClassName('harga')
        var jumlah = document.getElementsByClassName('totalprice')
        var totalbill = 0
        $(jumlah).each(function (index, value) {
            totalbill += Number($(value).val())
        })
        $('#totalbill').val(totalbill)
    })
</script>
@endsection