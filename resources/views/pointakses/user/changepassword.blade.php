@extends('frontend.customer.layouts.menu')
@include('frontend.include.header')
@section('menu')

<!--Page header & Title-->
<section id="page_header">
    <div class="page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">Shopping  Cart</h2>
                    <p>UINSA FOOD</p>
                </div>
            </div>
        </div>
    </div>
</section>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 ">
                        <div class="card">
                            <div class="card-header">Update Password</div>

                            <div class="card-body">
                                <form action="{{route('changepassword')}}" method="POST" enctype="multipart/form-data">
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

@endsection