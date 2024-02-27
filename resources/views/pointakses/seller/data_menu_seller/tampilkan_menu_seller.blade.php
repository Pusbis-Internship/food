@extends('pointakses.seller.layouts.dashboard')

@section('content_seller')

<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <a href="{{ route('createmenuseller') }}" class="btn btn-success">Tambah Menu</a>
    <div class="content">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DATA MENU</h3>

                    <div class="card-tools">
                        <form action="{{route('data_menu_seller')}}" method="GET">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="search" name="search" class="form-control float-right"
                                       placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Gambar Menu</th>
                                <th>Nama Menu</th>
                                <th>Harga Menu</th>
                                <th>Kategori</th>
                                <th>Vendor</th>
                                <th>Min Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                @if($menu->users_id == auth()->id()) <!-- Filter hanya menampilkan data yang dibuat oleh pengguna yang login -->
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>M{{ $menu->id }}</td>
                                        <td class="text-center">
                                            <img src="{{ url('storage/menu_images/' . basename($menu->menu_pic)) }}"
                                                class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $menu->menu_name }}</td>
                                        <td>{{ $menu->menu_price }}</td>
                                        <td>
                                            @if ($menu->category)
                                                {{ $menu->category->category_name }}
                                            @else
                                                No Category
                                            @endif
                                        </td>
                                        <td>{{ $menu->users_id }}</td>
                                        <td>{{ $menu->min_order_time }}</td>
                                        <td>
                                            <a href="{{ route('deletemenuseller', ['id' => $menu->id]) }}"
                                                class="btn btn-danger"
                                                onclick="return confirmDelete('{{ $menu->id }}', '{{ $menu->menu_name }}');">
                                                Hapus
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('editmenuseller', $menu->id) }}" class="btn btn-info">Edit</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@include('pointakses.seller.include.sidebar_seller')
@endsection
