<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\Order;

class OrderController extends Controller
{
    public function placeOrder(Request $request): RedirectResponse
    {
        $orderData = Session::get("order_" . auth()->id());
    
        // Mendapatkan id_pesanan yang sama untuk semua menu dalam satu pesanan
        $orderId = Order::max('id_pesanan') + 1;
    
        foreach ($orderData as $orderDetail) {
            $orderDetail['id_pesanan'] = $orderId; // Tetapkan id_pesanan ke setiap detail order
    
            $order = new Order([
                'users_id' => auth()->id(),
                'menu_id' => $orderDetail['menu_id'],
                'menu_name' => $orderDetail['menu_name'],
                'seller' => $orderDetail['seller'],
                'menu_pic' => $orderDetail['menu_pic'],
                'menu_price' => $orderDetail['menu_price'],
                'quantity' => $orderDetail['quantity'],
                'subtotal' => $orderDetail['subtotal'],
                'total' => $this->calculateTotal($orderData),
                'id_pesanan' => $orderId, // Menggunakan id_pesanan yang sama untuk semua menu dalam satu pesanan
                'nama_penerima' => $request->input('nama_penerima'), // Tambahkan data manual
                'alamat_pengiriman' => $request->input('alamat_pengiriman'), // Tambahkan data manual
                'fakultas' => $request->input('fakultas'), // Tambahkan data manual
                'tanggal' => $request->input('tanggal'), // Tambahkan data manual
                'jam' => $request->input('jam'), // Tambahkan data manual
            ]);
    
            $order->save();
        }
    
        // Update nilai 'total' setelah semua item order ditambahkan
        $this->updateOrderTotal($orderId);
    
        Session::forget("order_" . auth()->id());
    
        // Redirect ke halaman terima kasih atau halaman lainnya
        return redirect()->route('menu_user')->with('Berhasil', 'Transaksi berhasil.');
    }
    
    private function calculateTotal($orderData)
    {
        $total = 0;

        foreach ($orderData as $orderDetail) {
            $total += $orderDetail['subtotal'];
        }

        return $total;
    }

    private function updateOrderTotal($orderId)
    {
        $orderItems = Order::where('id', $orderId)->get();
    
        $totalOrder = $orderItems->sum('subtotal');
    
        foreach ($orderItems as $orderItem) {
            $orderItem->total = $totalOrder;
            $orderItem->save();
        }
    }
    
}