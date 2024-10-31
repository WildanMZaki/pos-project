@extends('layouts.adminlte')

@push('css')
    
@endpush

@section('content')
<section class="content-header">
    <h1>
        Edit Petugas
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/dash') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('/petugas') }}"><i class="fa fa-dashboard"></i> Daftar Petugas</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Isikan data-data berikut</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="fullname">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') ?? $petugas->fullname }}">
                  @error('nama_lengkap')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email_petugas" class="form-control" id="email" placeholder="Masukkan email" value="{{ old('email_petugas') ?? $petugas->email }}">
                  @error('email_petugas')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="kata_sandi" class="form-control" id="password" placeholder="*********" value="{{ old('kata_sandi') }}">
                  @error('kata_sandi')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="avatar">Foto Petugas</label>
                  <input type="file" id="avatar" name="avatar">
                  @error('avatar')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <p class="help-block">Tambahkan foto petugas ukuran 500 * 200 px</p>
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