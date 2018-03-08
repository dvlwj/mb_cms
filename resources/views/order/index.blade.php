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
        {{--  <form class="form-horizontal" action="{{ route('order.store') }}" method="post" enctype="multipart/form-data" >  --}}
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" >
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
                                        <input type="text" class="form-control" id="buyer_phone" name="buyer_phone" placeholder="Nomor Telepon" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
                            {{--  @foreach ($categories as $category)
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
                            @endforeach  --}}
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
            // console.log(e.target)
            // console.log(e.target.value)
            $(e.target).find('[value=""]').prop("disabled", true)
            var harga = $(e.target).parent().parent().find('[name="harga"]')
            var totalHarga = $(e.target).parent().parent().find('[name="total_harga"]')
            var jumlah = $(e.target).parent().parent().find('[name="jumlah"]')
            var splitVal = e.target.value.split('@')
            var categoryId = splitVal[0]
            // var codeProduct = splitVal[1]
            // var selectedProduct = products[categoryId].find(function(value, index) {
            //     return value.product_code == codeProduct
            // })
            var idProduct = splitVal[1]
            var selectedProduct = products[categoryId].find(function(value, index) {
                return value.id == idProduct
            })
            // harga.value = Number(selectedProduct.price)
            $(harga).val(selectedProduct.price)
            $(totalHarga).val(selectedProduct.price * $(jumlah).val())
            // console.log($(e.target).parent().parent().parent())
            // console.log($('#root').find('[name="total_harga"]'))
            var totalbill = 0
            var totalSelector = $('#root').find('[name="total_harga"]')
            // console.log(totalSelector)
            $(totalSelector).each(function(index, value){
                totalbill += Number($(value).val())
                // totalbill += $(value).val()
                // console.log(value)
            })
            // totalSelector.forEach(function(value, index) {
            // })
            $('#totalbill').val(totalbill)
            // console.log(totalbill)

            // console.log(selectedProduct)
            // var harga = $(e.target).parent().find('[name="harga"]')
            // console.log(harga)
            // console.log($(e.target).parent())
        }

        function handleChangeJumlah(e) {
            var jumlah = e.target.value
            var harga = $(e.target).parent().parent().find('[name="harga"]')
            var totalHarga = $(e.target).parent().parent().find('[name="total_harga"]')

            $(totalHarga).val(jumlah * $(harga).val())
            var totalbill = 0
            var totalSelector = $('#root').find('[name="total_harga"]')
            // console.log(totalSelector)
            $(totalSelector).each(function(index, value){
                totalbill += Number($(value).val())
                // totalbill += $(value).val()
                // console.log(value)
            })
            // totalSelector.forEach(function(value, index) {
            // })
            $('#totalbill').val(totalbill)
        }
    
        categories.map(function(category) {
            var product = products[category.id]
            var div = document.createElement('div')
            var cblock = document.createElement('div')
            var col6 = document.createElement('div')
            var col2 = document.createElement('div')
            var col1 = document.createElement('div')
            var col3 = document.createElement('div')
            var select = document.createElement('select')
            var option = document.createElement('option')
            var harga = document.createElement('input')
            var jumlah = document.createElement('input')
            var totalharga = document.createElement('input')

            option.value = ''
            option.innerHTML = 'Pilih ' + category.category_name
            div.className = 'row'
            cblock.className = 'center-block'
            col6.className = 'col-md-6'
            col2.className = 'col-md-2'
            col1.className = 'col-md-1'
            col3.className = 'col-md-3'
            harga.className = 'form-control'
            select.className = 'form-control'
            jumlah.className = 'form-control'
            totalharga.className = 'form-control'
            div.setAttribute("style","margin:1em 0;")
            jumlah.setAttribute("type","number")
            jumlah.setAttribute("value","1")
            jumlah.setAttribute("min","1")
            jumlah.setAttribute("name","jumlah")
            harga.setAttribute("placeholder","Harga")
            harga.setAttribute("name","harga")
            totalharga.setAttribute("placeholder","Total Harga")
            totalharga.setAttribute("name","total_harga")
            harga.readOnly = true
            totalharga.readOnly = true
            select.addEventListener('change', handleChangeProduct)
            jumlah.addEventListener('change', handleChangeJumlah)
            // select.addEventListener('change', handleChangeProduct(products))
            select.append(option)
            productmap = product.map(function(p) {
                var option = document.createElement('option')
                option.innerHTML = p.product_name
                // option.value = category.id + '@' + p.product_code
                option.value = category.id + '@' + p.id
                // option.value = category.id + product.product_name
                // option.value = p.product_code
                select.append(option)
            })
            div.append(cblock)
            cblock.append(col6,col2,col1,col3)
            col6.append(select)
            col2.append(harga)
            col1.append(jumlah)
            col3.append(totalharga)
            root.append(div)
        })
    })
    var submit = $('button[type="submit"]')
    submit.on('click', function(e) {
        e.preventDefault()

        var name = $('#buyer_name').val()
        var phone = $('#buyer_phone').val()
        var address = $('#buyer_address').val()
        var order = $('#root').find('select')
        var payload = {
            buyer_name: name,
            buyer_address: address,
            buyer_phone: phone,
            order: []
        }
        if (name == "" || phone == "" || address == "") {
            toastr.warning("Harap isi identitas pemesan dengan lengkap")
            return false
        }        
        $(order).each(function(index, value) {
            splitProduct = $(value).val().split('@')
            // var splitProduct = e.target.value.split('@')
            var idProduct = splitProduct[1]
            var jumlah = $(e.target).parent().parent().find('[name="jumlah"]')
            if (idProduct !== undefined) {
                payload.order.push({ product_id: idProduct, amount: jumlah.val() })
            }
            // console.log($(value).val())
        })
        if (payload.order.length <= 0 ) {
            toastr.warning("Harap isi produk yang dipesan")
            return false
        }
        $.ajax({
            method: 'POST',
            beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
            url: '{{route("json/store")}}',
            // data:  JSON.stringify(payload),
            data:  payload,
            success: function(response){
                console.log(response)
                setTimeout(function () {
                    toastr.success('Pesanan berhasil ditambahkan !')
                    toastr.success('Halaman akan direfresh dalam beberapa detik !')
                }, 100);
                setTimeout(function() {
                    localStorage.setItem('kode_pesanan', response)
                    window.location.replace("{{route('ordersuccess')}}")
                    // location.reload();
                },2000);
                // console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // toastr.warning(JSON.stringify(jqXHR));
                toastr.warning("Terjadi Error, Pastikan anda mengisi data dengan baik dan benar");
                toastr.error("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        })
        console.log(payload)
        // console.log(order)
    })
</script>
@endsection