@extends('layouts.adminlte')

@push('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<section class="content-header">
    <h1>
        List Transaksi
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('/dash') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">List Transaksi</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Transaksi Hari Ini</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ route('transactions.create') }}">
                            <button class="btn btn-success">
                                Tambah Transaksi
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- Nanti di sini akan dibuat tabel --}}
                    <table class="table table-striped table-responsive" id="tabel-products">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nota</th>
                                <th>Pembayaran</th>
                                <th>Total</th>
                                <th>Diskon</th>
                                <th>Grand Total</th>
                                <th>Bayar</th>
                                <th>Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
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