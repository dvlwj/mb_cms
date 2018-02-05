@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                <i class="fa fa-fw fa-close"></i>
            </a>
            {{$message}}
        </div>
        @endif
        <form class="form-horizontal" action="{{ route('order.store') }}" method="post" enctype="multipart/form-data" >
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        <div class="container-fluid">
                            {{--  <div class="col-md-3">
                                <select class="form-control" id="category_id" name="category_id" autofocus>
                                    <option value="{{$category->id}}">
                                        {{$category->category_name}}
                                    </option>
                                </select>
                            </div>  --}}
                            {{--  {{dd($category)}}  --}}
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('buyer_name') ? 'has-error' : '' }}">
                                    <label class="control-label col-md-4" for="buyer_name">Nama Pembeli :</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="buyer_name" name="buyer_name" placeholder="Nama Pengirim" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('buyer_phone') ? 'has-error' : '' }}">
                                    <label class="control-label col-md-4" for="buyer_phone">Nomor Telepon :</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="buyer_phone" name="buyer_phone" placeholder="Nomor Telepon" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('buyer_address') ? 'has-error' : '' }}">
                                    <label class="control-label col-md-2" for="buyer_address">Alamat :</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="buyer_address" name="buyer_address" placeholder="Alamat" required>
                                    </div>
                                </div>
                            </div>
                            @foreach ($categories as $category)
                            <div class="row" style="margin:1em 0;">
                                <div class="center-block">
                                    <div class="col-md-6">
                                        <select class="form-control" id="{{$category->id}}/kategori" name="{{$category->id}}/produk" placeholder="{{$category->category_name}}" required>
                                            <option value="0" disabled selected>Pilih {{$category->category_name}}</option>
                                            @foreach($products as $product)
                                                @if($product->category_id == $category->id)
                                                <option value="{{$product->id}}|{{$product->price}}" required>
                                                    {{$product->product_name}}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" id="{{$category->id}}/price" name="{{$category->id}}/price" placeholder="Harga" disabled>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="{{$category->id}}/amount" name="{{$category->id}}/amount" placeholder="Jumlah" value="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control totalprice" id="{{$category->id}}/totalprice" name="{{$category->id}}/totalprice" placeholder="Total Harga" disabled>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-12">
                                <input type="number" class="form-control" id="totalbill" name="totalbill" placeholder="Total Harga Pesanan" disabled>
                            </div>
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
                    <button type="submit" class="btn btn-primary" style="width:100%">Pesan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    function sumDomArray(dom){
        var ii = 0, sum = 0, chunk;
        for(;ii<dom.length;) {
            chunk = parseInt(dom[ii++].value);
            sum += isNaN(chunk) ? 0 : chunk;
        }
        return sum;
    }
    @foreach ($categories as $category)
    document.getElementById('{{$category->id}}/kategori').addEventListener('change', function () {
        var category = document.getElementById('{{$category->id}}/kategori');
        var price = document.getElementById('{{$category->id}}/price');
        var number = document.getElementById('{{$category->id}}/amount');
        var totalprice = document.getElementById('{{$category->id}}/totalprice');
        var totalbill = document.getElementById('totalbill');
        price.value = category.value.split('|')[1];
        totalprice.value = price.value * number.value;
        totalbill.value = sumDomArray(document.getElementsByClassName('totalprice'));
    });
    document.getElementById('{{$category->id}}/amount').addEventListener('change', function () {
        var category = document.getElementById('{{ $category-> id }}/kategori');
        var price = document.getElementById('{{ $category-> id }}/price');
        var number = document.getElementById('{{ $category-> id }}/amount');
        var totalprice = document.getElementById('{{ $category-> id }}/totalprice');
        var totalbill = document.getElementById('totalbill');
        price.value = category.value.split('|')[1];
        totalprice.value = price.value * number.value;
        totalbill.value = sumDomArray(document.getElementsByClassName('totalprice'));
    });
    @endforeach
</script>
@endsection