@extends('pointakses.seller.layouts.dashboard')
@section('content_seller')

<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <div class="container">
        <div class="row justify-content-center">
            @if (session()->has('message'))
            <div class="text-green-6 mb-4">{{session()->get('message')}}</div>
            @endif
            <div class="col-md-8 ">
                <div class="card">
                    <br>
    
                    <div class="card-body">
                        <form action="{{route('updateseller')}}" method="POST" enctype="multipart/form-data">
                            @csrf
    
                            @method('PUT')
    
                            <div class="form-group">
                                <label for="nama_lengkap">Nama</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->nama_lengkap)}}">
    
                                @error('nama_lengkap')
                                    <div class="text-red-500 mt-2 text-sm">{{$message}}</div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email',Auth::user()->email ) }}">
                            </div>
    
                            <div class="form-group">
                                <label for="no_tlp">No Telepon</label>
                                <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="{{ old('no_tlp',Auth::user()->no_tlp ) }}">
                            </div>
    
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat',Auth::user()->alamat ) }}">
                            </div>
    
                            <div class="form-group">
                                <label for="unit_kerja">Unit Kerja</label>
                                <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" value="{{ old('unit_kerja', Auth::user()->unit_kerja) }}">
                            </div>
    
    
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{route('editpwseller')}}" class="btn btn-primary">Change Password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pointakses.seller.include.sidebar_seller')
@endsection
