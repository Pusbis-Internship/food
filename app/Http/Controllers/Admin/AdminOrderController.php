<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function groupDataByCreatedAt(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $groupedOrdersQuery = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap',
                DB::raw('GROUP_CONCAT(CONCAT(menu_name, " (", quantity, ")") SEPARATOR ", ") as menu_with_quantity'))
            ->whereIn('status',['pending']);
                
        if ($startDate && $endDate) {
                $groupedOrdersQuery->whereBetween('orders.tanggal', [$startDate, $endDate]);
            }
            
        $groupedOrders = $groupedOrdersQuery
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap')
            ->get();

        return view('pointakses/admin/data_transaksi/tampilkan_transaksi', ['groupedOrders' => $groupedOrders]);
    }

    public function admin_invoice($id_pesanan)
    {
        // Retrieve the grouped orders
        $groupedOrders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap','status', 
                DB::raw('GROUP_CONCAT(menu_name) as menu_names'), 
                DB::raw('GROUP_CONCAT(seller) as sellers'),
                DB::raw('GROUP_CONCAT(menu_price) as menu_prices'),  
                DB::raw('GROUP_CONCAT(subtotal) as subtotals'), 
                DB::raw('GROUP_CONCAT(quantity SEPARATOR ", ") as quantities'))
            ->where('id_pesanan', $id_pesanan)
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap','status')
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

    public function history_order(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $groupedOrdersQuery = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->select('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'status', 'users.nama_lengkap',
                DB::raw('GROUP_CONCAT(CONCAT(menu_name, " (", quantity, ")") SEPARATOR ", ") as menu_with_quantity'))
            ->whereIn('status',['Setuju', 'Tolak']);
        
        if ($startDate && $endDate) {
                $groupedOrdersQuery->whereBetween('tanggal', [$startDate, $endDate]);
            }

        $groupedOrders = $groupedOrdersQuery
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'status', 'users.nama_lengkap')
            ->get();

        return view('pointakses/admin/data_transaksi/history', ['groupedOrders' => $groupedOrders]);
    }
}