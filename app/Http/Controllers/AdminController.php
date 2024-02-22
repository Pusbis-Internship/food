<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = DB::table('orders')->count();
        $totalacceptedorders = DB::table('orders')->where('status', 'setuju')->count();
        $totalsellers = DB::table('users')->where('role', 'seller')->count();
        $totalmenus = DB::table('table_menu')->count();

        $groupedOrders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap', 'status',
                DB::raw('GROUP_CONCAT(CONCAT(menu_name, " (", quantity, ")") SEPARATOR ", ") as menu_with_quantity'))
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap', 'status')
            ->get();

        return view('pointakses/admin/index', ['groupedOrders' => $groupedOrders], compact('totalOrders', 'totalacceptedorders', 'totalsellers', 'totalmenus'));
    }
}