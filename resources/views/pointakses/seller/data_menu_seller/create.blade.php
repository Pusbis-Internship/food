@extends('pointakses.seller.layouts.dashboard')

@section('content_seller')
    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="600">

        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Tambah Menu</h3>
            </div>
            <form action="{{ route('menusseller') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="menu_name">Nama Menu</label>
                        <input type="text" class="form-control @error('menu_name') is-invalid @enderror" id="menu_name" placeholder="Nama Menu" name="menu_name" value="{{ old('menu_name') }}">
                        @error('menu_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="menu_price">Harga Menu</label>
                        <input type="number" class="form-control @error('menu_price') is-invalid @enderror" id="menu_price" placeholder="Harga Menu" name="menu_price" value="{{ old('menu_price') }}">
                        @error('menu_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="menu_pic">Gambar Menu</label>
                        <input type="file" class="form-control @error('menu_pic') is-invalid @enderror" name="menu_pic">
                        @error('menu_pic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Select Category</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                            <option value="" selected>Select Category</option>

                            @if ($categories && count($categories) > 0)
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category->category_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            <label for="menu_desc">Deskripsi Menu:</label>
                            <textarea class="form-control @error('menu_desc') is-invalid @enderror" name="menu_desc" id="menu_desc" rows="3" placeholder="Enter ...">{{ old('menu_desc') }}</textarea>
                            @error('menu_desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('data_menu_seller') }}" class="btn btn-primary">Kembali ke Daftar Menu</a>
                </div>
            </form>
        </div>

        @include('pointakses.seller.include.sidebar_seller')
    </div>
@endsection
