@extends('layouts.adminlte')

@push('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<section class="content-header">
    <h1>
        Master Petugas
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('/dash') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Master Petugas</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Petugas</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ route('petugas.create') }}">
                            <button class="btn btn-success">
                                Tambah Petugas
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- Nanti di sini akan dibuat tabel --}}
                    <table class="table table-striped table-responsive" id="tabel-petugas">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_petugas as $index => $petugas)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>
                                        <img src="{{ $petugas->avatar ? asset("storage/" . $petugas->avatar) : asset('images/defaults/poto.jpeg') }}" alt="Foto {{ $petugas->fullname }}" class="img-fluid" style="max-height: 50px;">
                                    </td>
                                    <td>{{ $petugas->fullname }}</td>
                                    <td>{{ $petugas->email }}</td>
                                    <td>
                                        @if ($petugas->active == 1)
                                            <small class="label bg-green">Aktif</small>
                                        @else
                                            <small class="label bg-red">Inaktif</small>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('petugas.edit', $petugas->id) }}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        
                                        <form action="{{ route('petugas.active_control', $petugas->id) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('patch')
                                            @if ($petugas->active == 1)
                                                <button class="btn btn-secondary">
                                                    <i class="fa fa-eye-slash"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-success">
                                                    <i class="fa fa-eye-slash"></i>
                                                </button>
                                            @endif
                                            
                                        </form>
                                        <form action="{{ route('petugas.delete', $petugas->id) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
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
    $('#tabel-petugas').DataTable({
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