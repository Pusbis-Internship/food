<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function groupDataByCreatedAt()
    {
        $groupedOrders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap',
                DB::raw('GROUP_CONCAT(menu_name SEPARATOR ", ") as menu_names'))
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap')
            ->whereIn('status',['pending'])
            ->get();

        return view('pointakses/admin/data_transaksi/tampilkan_transaksi', ['groupedOrders' => $groupedOrders]);
    }

    public function admin_invoice($id_pesanan)
    {
        // Retrieve the grouped orders
        $groupedOrders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap', 
                DB::raw('GROUP_CONCAT(menu_name) as menu_names'), 
                DB::raw('GROUP_CONCAT(seller) as sellers'), 
                DB::raw('GROUP_CONCAT(subtotal) as subtotals'), 
                DB::raw('GROUP_CONCAT(quantity SEPARATOR ", ") as quantities'))
            ->where('id_pesanan', $id_pesanan)
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap')
            ->get();
        
        // Return the view with the data
        return view('pointakses.admin.data_transaksi.admin_invoice', compact('groupedOrders'));
    }

    public function accept($id_pesanan){
        DB::table('orders')

        ->where('id_pesanan', $id_pesanan)
    
        ->update(['status'=>'Setuju']);
    
        return redirect()->route('admin.orders')->with('sucess', 'Order Telah Disetujui');
    }
    public function reject($id_pesanan){
        DB::table('orders')

        ->where('id_pesanan', $id_pesanan)
    
        ->update(['status'=>'Tolak']);
    
        return redirect()->route('admin.orders')->with('success', 'Order Telah Ditolak');
    }

    public function history_order()
    {
        $groupedOrders = DB::table('orders')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam','status', 
                DB::raw('GROUP_CONCAT(menu_name SEPARATOR ", ") as menu_names'))
            ->whereIn('status',['Setuju', 'Tolak'])
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam','status')
            ->get();

        return view('pointakses/admin/data_transaksi/history', ['groupedOrders' => $groupedOrders]);
    }
}