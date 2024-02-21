<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    function index() {
        return view('pointakses/seller/index');
    }

    public function seller_order()
    {
        $userId = Auth::id();
    
        $groupedOrders = DB::table('orders')
        ->join('table_menu', 'orders.menu_name', '=', 'table_menu.menu_name')
        ->join('users', 'orders.users_id', '=', 'users.id')
        ->select('orders.id_pesanan', 'orders.total', 'orders.nama_penerima', 'orders.alamat_pengiriman', 'orders.fakultas', 'orders.tanggal', 'orders.jam', 'users.nama_lengkap', 'status',
            DB::raw('GROUP_CONCAT(CONCAT(orders.menu_name, " (", quantity, ")") SEPARATOR ", ") as menu_with_quantity'))
        ->where('table_menu.users_id', $userId)
        ->groupBy('orders.id_pesanan', 'orders.total', 'orders.nama_penerima', 'orders.alamat_pengiriman', 'orders.fakultas', 'orders.tanggal', 'orders.jam', 'users.nama_lengkap','status')
        ->get();

    return view('pointakses/seller/data_order/tampilkan_order', ['groupedOrders' => $groupedOrders]);
    }

    public function seller_invoice($id_pesanan)
    {
        $userId = Auth::id();
        
        $groupedOrders = DB::table('orders')
            ->join('table_menu', 'orders.menu_name', '=', 'table_menu.menu_name')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap','status', 
                DB::raw('GROUP_CONCAT(orders.menu_name) as menu_names'), 
                DB::raw('GROUP_CONCAT(orders.seller) as sellers'), 
                DB::raw('GROUP_CONCAT(orders.menu_price) as menu_prices'), 
                DB::raw('GROUP_CONCAT(orders.subtotal) as subtotals'), 
                DB::raw('GROUP_CONCAT(orders.quantity SEPARATOR ", ") as quantities'))
            ->where('id_pesanan', $id_pesanan)
            ->where('table_menu.users_id', $userId)
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap','status')
            ->get();
        
        // Return the view with the data
        return view('pointakses/seller/data_order/seller_invoice', compact('groupedOrders'));
    }
}