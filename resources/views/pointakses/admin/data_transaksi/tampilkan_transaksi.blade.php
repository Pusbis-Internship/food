@extends('pointakses.admin.layouts.dashboard')'

@section('content')

    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
        <div class="content">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">

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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedOrders as $groupedOrder)
                                    <tr>
                                        <td><strong>ID Pesanan:  {{ $groupedOrder->id_pesanan }} </strong> 
                                            <br>Menu:  {{ $groupedOrder->menu_names }}
                                            <br>Total:  {{ $groupedOrder->total }}
                                        </td>
                                        <td><a href="#"
                                                class="btn btn-info">Download</a>
                                            </td>
                                    </tr>
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
    @include('pointakses.admin.include.sidebar_admin')
@endsection


                        