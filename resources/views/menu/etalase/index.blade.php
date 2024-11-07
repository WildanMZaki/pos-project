@extends('layouts.adminlte')

@push('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<section class="content-header">
    <h1>
        Etalase
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('/dash') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Etalase</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Produk</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- Nanti di sini akan dibuat tabel --}}
                    <table class="table table-striped table-responsive" id="tabel-products">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    {{-- <td>{{ $product->purchases()->sum('qty') - $product->sold()->sum('qty') }}</td> --}}
                                    <td>{{ $product->stok }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $('#tabel-products').DataTable({
        language: {
            sProcessing: "Sedang memproses...",
            sLengthMenu: "Tampilkan _MENU_ data",
            sZeroRecords: "Tidak ditemukan data yang sesuai",
            sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            sInfoFiltered: "(disaring dari _MAX_ data keseluruhan)",
            sInfoPostFix: "",
            sSearch: "Cari:",
            sUrl: "",
            oPaginate: {
                sFirst: "Pertama",
                sPrevious: "Sebelumnya",
                sNext: "Selanjutnya",
                sLast: "Terakhir"
            }
        }
    });
</script>
@endpush