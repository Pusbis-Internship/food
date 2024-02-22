@extends('pointakses.admin.layouts.dashboard')
@section('content')

<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3 mt-4 ">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Vendor</span>
          <span class="info-box-number">
            {{ $totalsellers }}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3 mt-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Diproses</span>
          <span class="info-box-number">{{ $totalacceptedorders }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3 mt-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Order</span>
          <span class="info-box-number">{{ $totalOrders }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3 mt-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Menu</span>
          <span class="info-box-number">{{ $totalmenus }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right"
                    placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Data Order</th>
                    <th>Invoice</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedOrders as $groupedOrder)
                <tr>
                    <td><strong>ID Pesanan: {{ $groupedOrder->id_pesanan }} </strong>
                        <br><strong>Pemesan: {{$groupedOrder->nama_lengkap}}</strong>
                        <br>Menu (Jumlah): {{ $groupedOrder->menu_with_quantity }}
                        <br>Total: {{ $groupedOrder->total }}
                        <br>Nama Penerima: {{ $groupedOrder->nama_penerima }}
                        <br>Alamat Pengiriman: {{ $groupedOrder->alamat_pengiriman }}
                        <br>fakultas: {{ $groupedOrder->fakultas }}
                        <br>Tanggal & Jam: {{ $groupedOrder->tanggal }}, {{$groupedOrder->jam}}
                    </td>
                    <td>@isset($groupedOrder->id_pesanan)
                        <a href="{{ route('admin_invoice', ['id_pesanan' => $groupedOrder->id_pesanan]) }}"
                            class="btn btn-info">Lihat Invoice</a>
                        @endisset</td>
                    <td> 
                      <strong>{{ $groupedOrder->status }}</strong>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>

@include('pointakses.admin.include.sidebar_admin')
@endsection