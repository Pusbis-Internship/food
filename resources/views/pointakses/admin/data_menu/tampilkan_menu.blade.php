@extends('pointakses.admin.layouts.dashboard')'


@section('content')


<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
    }
</style>

  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Gambar Menu</th>
            <th>Kategori</th>
            <th>Vendor</th>
            <th>Nama Menu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
        <tr>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@include('pointakses.admin.include.sidebar_admin')>

@endsection
