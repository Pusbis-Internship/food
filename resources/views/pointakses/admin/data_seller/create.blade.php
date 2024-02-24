@extends('pointakses.admin.layouts.dashboard')'

@section('content')
    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="600">

        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Tambah Akun Seller</h3>
            </div>
            <form action="{{ route('storeseller') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="#">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Seller" required>
                    </div>

                    <div class="form-group">
                        <label for="#">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="#">Nomer Telepon</label>
                        <input type="text" name="no_tlp"  class="form-control" placeholder="Nomer Telepon" required>
                    </div>

                    <div class="form-group">
                        <label for="#">UNIT KERJA</label>
                        <input type="text" name="unit_kerja"  class="form-control" placeholder="UNIT KERJA" required>
                    </div>

                    <div class="form-group">
                        <label for="#">ALAMAT LENGKAP</label>
                        <input type="text" name="alamat" class="form-control" placeholder="ALAMAT LENGKAP" required>
                    </div>

                    <div class="form-group">
                        <label for="#">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('dataseller') }}" class="btn btn-primary">Kembali ke Daftar Seller</a>
                </div>
            </form>
        </div>


        @include('pointakses.admin.include.sidebar_admin')>

    @endsection