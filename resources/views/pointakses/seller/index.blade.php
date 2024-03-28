@extends('pointakses.seller.layouts.dashboard')
@section('content_seller')

<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="card">
    <div class="card-body table-responsive p-0">
    @if($groupedOrders->isEmpty())
    <br>
    <br>
    <div class="d-flex justify-content-center">
      <div class="badge bg-primary text-wrap" style="width: 6rem;">
        KOSONG
      </div>
    </div>
    <br>
    <h2 class="text-center"><strong><em>Belum ada pesanan saat ini~</em></strong></h2>
      @else
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Data Order</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedOrders as $groupedOrder)
                <tr>
                    <td><strong>ID Pesanan: {{ $groupedOrder->id_pesanan }} </strong>
                        <br><strong>Pemesan: {{$groupedOrder->nama_lengkap}}</strong>
                        <br>Menu (Jumlah): {{ $groupedOrder->menu_with_quantity }}
                        <br>Total: Rp. {{ number_format($groupedOrder->total, 0, ',', '.') }}
                        <br>Nama Penerima: {{ $groupedOrder->nama_penerima }}
                        <br>Alamat Pengiriman: {{ $groupedOrder->alamat_pengiriman }}
                        <br>Fakultas: {{ $groupedOrder->fakultas }}
                        <br>Tanggal & Jam: {{ $groupedOrder->tanggal }}, {{$groupedOrder->jam}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    @endif
    <div class="container px-4 mx-auto"> 

      <div class="p-6 m-20 bg-white rounded shadow">
        {!! $chart->container() !!}
      </div>

    </div>
  </div>
</div>

<script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
@include('pointakses.seller.include.sidebar_seller')
@endsection