@extends('pointakses.seller.layouts.dashboard')
@section('content_seller')

<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Update Password</div>

                    <div class="card-body">
                        <form action="{{route('updatepwseller')}}" method="POST" enctype="multipart/form-data">
                            @csrf   

                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input type="password" class="form-control"  name="current_password" required>
                             @error('password_lama')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" class="form-control"  name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" class="form-control"  name="password_confirmation" required>
                            </div>


                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pointakses.seller.include.sidebar_seller')
@endsection