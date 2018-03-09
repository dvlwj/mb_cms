@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li class="active">
                Konfirmasi Pesanan
            </li>
        </ol>
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
            {{$message}}
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Pesanan
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-condensed table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Kode Pemesanan</th>
                            <th>Status Pemesanan</th>
                            <th>Diedit oleh</th>
                            <th>Diedit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($confirm as $confirmed)
                        <tr onclick="window.location='{{route('process_check_order', $confirmed->purchase_order_code)}}';">
                            {{--  <a href="{{route('process_check_order', $confirmed->purchase_order_code)}}">  --}}
                                <td class="text-center">{{$no++}}</td>
                                <td class="text-center">{{$confirmed->buyer_name}}</td>
                                <td class="text-justify">{{$confirmed->buyer_address}}</td>
                                <td class="text-center">{{$confirmed->buyer_phone}}</td>
                                <td class="text-center">{{$confirmed->purchase_order_code}}</td>
                                <td class="text-center">{{$confirmed->status}}</td>
                                @if($confirmed->updator!=null)
                                <td class="text-center">{{$confirmed->updater->username}}</td>
                                @else
                                <td class="text-center">-</td>
                                @endif
                                <td class="text-center">{{date('H:i:s d-m-Y', strtotime($confirmed->updated_at))}}</td>
                                <td class="text-center" width="8%">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{ route('products.destroy', $confirmed->id) }}" method="post">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ route('products.edit', $confirmed->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-faw fa-pencil"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            {{--  </a>  --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer footer-fix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{route('products.create')}}" class="pagination btn btn-primary">
                                <i class="fa fa-fw fa-plus"></i>Tambah Data
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            {{$confirm->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection