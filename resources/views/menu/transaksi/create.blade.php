@extends('layouts.adminlte')

@push('css')
<style>
    .product-item {
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .product-checkbox:checked + .product-content {
        background-color: #cce5ff; /* Light blue color for selected state */
        /* border: 1px solid #007bff; */
    }
</style>
@endpush

@section('content')
<section class="content-header">
    <h1>
        Tambah Transaksi
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('/dash') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ url('/transaksi') }}"><i class="fa fa-dashboard"></i> Daftar Transaksi</a></li>
    <li class="active">Tambah Transaksi</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Transaksi Hari Ini</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-list-products">
                            Tambah Produk
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- Nanti di sini akan dibuat tabel --}}
                    <table class="table table-striped table-responsive" id="tabel-products">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selected_products as $trx_detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trx_detail->product->name }}</td>
                                    <td>{{ $trx_detail->qty }}</td>
                                    <td>{{ $trx_detail->price }}</td>
                                    <td>{{ $trx_detail->qty * $trx_detail->price }}</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-6">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Kembali</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Total</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-list-products">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('transactions.store_products') }}" method="post">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">List Produk</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($products as $product)
                            @if ($product->stok > 0)
                                <label class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center justify-content-center product-item" style="min-height: 120px; min-width: 120px;">
                                    <input type="checkbox" class="product-checkbox" name="products[]" style="display: none;" value="{{ $product->id }}">
                                    <div class="product-content">
                                        <img src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('images/defaults/poto.jpeg') }}" 
                                            alt="" class="img-fluid" style="max-height: 100px; max-width: 100px;">
                                        <h5>{{ $product->name }}</h5>
                                        <h6>{{ $product->stok }} tersisa</h6>
                                    </div>
                                </label>
                            @endif
                        @endforeach
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
