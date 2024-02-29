<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
            ->select(
                'id_pesanan',
                'total',
                'nama_penerima',
                'alamat_pengiriman',
                'fakultas',
                'tanggal',
                'jam',
                'users.nama_lengkap',
                'status',
                DB::raw('GROUP_CONCAT(CONCAT(menu_name, " (", quantity, ")") SEPARATOR ", ") as menu_with_quantity')
            )
            ->groupBy('id_pesanan', 'total', 'nama_penerima', 'alamat_pengiriman', 'fakultas', 'tanggal', 'jam', 'users.nama_lengkap', 'status')
            ->get();

        return view('pointakses/admin/index', ['groupedOrders' => $groupedOrders], compact('totalOrders', 'totalacceptedorders', 'totalsellers', 'totalmenus'));
    }

    function seller()
    {
        $sellers = User::where('role', 'seller')->get();

        return view('pointakses/admin/data_seller/tampil_seller', compact('sellers'));
    }

    function sellercreate()
    {
        return view('pointakses/admin/data_seller/create');
    }

    function storeseller(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'no_tlp' => 'required|string',
            'alamat' => 'required|string',
            'unit_kerja' => 'required|string',
            'password' => 'required|min:8',
        ]);

        // Membuat akun seller baru
        $seller = new User();
        $seller->nama_lengkap = $request->input('nama_lengkap');
        $seller->email = $request->input('email');
        $seller->no_tlp = $request->input('no_tlp');
        $seller->alamat = $request->input('alamat');
        $seller->unit_kerja = $request->input('unit_kerja');
        $seller->password = Hash::make($request->input('password'));
        $seller->role = 'seller'; // Menetapkan role sebagai 'seller'

        // Simpan data ke database
        $seller->save();

        // Mungkin Anda ingin menambahkan logika lain, seperti mengirim email verifikasi, dll.

        return redirect()->route('dataseller')->with('message', 'data berhasil dibuat');
    }

    function deleteseller($id)
    {
        $sellers = User::find($id);
        $sellers->delete();

        return redirect()->back();
    }
}