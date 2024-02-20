<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function groupDataByCreatedAt()
    {
        $groupedOrders = DB::table('orders')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', DB::raw('GROUP_CONCAT(menu_name SEPARATOR ", ") as menu_names'))
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam')
            ->get();

        return view('pointakses/admin/data_transaksi/tampilkan_transaksi', ['groupedOrders' => $groupedOrders]);
    }

    public function accept($id_pesanan){
        DB::table('orders')

        ->where('id_pesanan', $id_pesanan)
    
        ->update(['status'=>'setuju']);
    
        return redirect()->route('admin.orders')->with('sucess', 'Order Telah Disetujui');
    }
    public function reject($id_pesanan){
        DB::table('orders')

        ->where('id_pesanan', $id_pesanan)
    
        ->update(['status'=>'tolak']);
    
        return redirect()->route('admin.orders')->with('success', 'Order Telah Ditolak');
    }

    public function history_order()
    {
        $groupedOrders = DB::table('orders')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam','status', DB::raw('GROUP_CONCAT(menu_name SEPARATOR ", ") as menu_names'))
            ->whereIn('status',['setuju', 'tolak'])
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam','status')
            ->get();

        return view('pointakses/admin/data_transaksi/history', ['groupedOrders' => $groupedOrders]);
    }
}