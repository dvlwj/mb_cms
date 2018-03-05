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
                            <div id="root"></div>
                            {{--  <select name="category" style="text-align: center;">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                            </select>
                            <select name="product" style="text-align: center;"></select>	  --}}
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->nama}}</option>
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
                                        <input type="number" class="form-control" id="{{$category->id}}/price" name="{{$category->id}}/price" placeholder="Harga" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="{{$category->id}}/amount" name="{{$category->id}}/amount" placeholder="Jumlah" value="1">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control totalprice" id="{{$category->id}}/totalprice" name="{{$category->id}}/totalprice" placeholder="Total Harga" readonly>
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
<script type="text/javascript">
    var root = document.getElementById('root')
    function getCategory() {
        return $.get(" {{route('json/category')}} ", function(resp) {
        return resp
        })
    }

    function getProduct() {
        return $.get(" {{route('json/product')}} ", function(resp) {
        return resp
        })
    }

    Promise.all([
        getCategory(),
        getProduct()
    ])
    .then(function([categories, products]) {
        function handleChangeProduct(e) {
        console.log(e.target.getAttribute('data-category'))
    }
    
    categories.map(function(category) {
        var product = products[category.id]
        var div = document.createElement('div')
        var select = document.createElement('select')
        var option = document.createElement('option')

        
        option.value = ''
        option.innerHTML = 'Pilih ' + category.category_name
        
        select.id = 'category-' + category.id
        select.className = 'form-control'
        select.addEventListener('change', handleChangeProduct)
        select.append(option)
        
        product.map(function(p) {
            var option = document.createElement('option')
            
            option.innerHTML = p.product_name
            option.value = p.product_code
            
            select.append(option)
        })
        div.className = 'row'
        div.append(select)
        root.append(div)
        })
    })
    // var root = $('#root');

    // $.get("{{route('json/category')}}", function(resp) {
    // categories = resp;
    // console.log(resp);
    // });

    // $.get("{{route('json/product')}}", function(resp) {
    // products = resp
    // console.log(resp)
    // });
</script>
<script>
    // function sumDomArray(dom){
    //     var ii = 0, sum = 0, chunk;
    //     for(;ii<dom.length;) {
    //         chunk = parseInt(dom[ii++].value);
    //         sum += isNaN(chunk) ? 0 : chunk;
    //     }
    //     return sum;
    // }
    // @foreach ($categories as $category)
    // document.getElementById('{{$category->id}}/kategori').addEventListener('change', function () {
    //     var category = document.getElementById('{{$category->id}}/kategori');
    //     var price = document.getElementById('{{$category->id}}/price');
    //     var number = document.getElementById('{{$category->id}}/amount');
    //     var totalprice = document.getElementById('{{$category->id}}/totalprice');
    //     var totalbill = document.getElementById('totalbill');
    //     price.value = category.value.split('|')[1];
    //     totalprice.value = price.value * number.value;
    //     totalbill.value = sumDomArray(document.getElementsByClassName('totalprice'));
    // });
    // document.getElementById('{{$category->id}}/amount').addEventListener('change', function () {
    //     var category = document.getElementById('{{ $category-> id }}/kategori');
    //     var price = document.getElementById('{{ $category-> id }}/price');
    //     var number = document.getElementById('{{ $category-> id }}/amount');
    //     var totalprice = document.getElementById('{{ $category-> id }}/totalprice');
    //     var totalbill = document.getElementById('totalbill');
    //     price.value = category.value.split('|')[1];
    //     totalprice.value = price.value * number.value;
    //     totalbill.value = sumDomArray(document.getElementsByClassName('totalprice'));
    // });
    // @endforeach
</script>
@endsection