@extends('layouts.adminlte')

@push('css')
    
@endpush

@section('content')
<section class="content-header">
    <h1>
        Tambah Data Belanja
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/dash') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('/purchases') }}"><i class="fa fa-dashboard"></i> Data Belanja</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Isikan data-data berikut</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Produk</label>
                            <select class="form-control" name="product_id">
                                <option selected disabled>Pilih produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="qty">Jumlah Barang</label>
                            <input type="number" name="qty" class="form-control" id="qty" placeholder="Masukkan jumlah barang" value="{{ old('qty') }}">
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="price">Harga Beli</label>
                            <input type="number" name="price" class="form-control" id="price" placeholder="Masukkan harga beli" value="{{ old('price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <input type="text" name="supplier" class="form-control" id="supplier" placeholder="Masukkan supplier" value="{{ old('supplier') }}">
                            @error('supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" name="note" rows="3" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    
@endpush