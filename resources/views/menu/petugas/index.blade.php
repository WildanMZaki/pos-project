@extends('layouts.adminlte')

@push('css')
    
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    
@endpush