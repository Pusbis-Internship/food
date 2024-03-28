<?php

namespace App\Charts;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class SellerChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
            $sellerId = Auth::id();

                // Mendapatkan semua pesanan berdasarkan seller yang sedang login
                $orders = Order::whereHas('menu', function($query) use ($sellerId) {
                    $query->where('users_id', $sellerId);
                })->get();

                // Memproses data pesanan untuk ditampilkan pada grafik
                $labels = [];
                $data = [];
                
                foreach ($orders as $order) {
                    $labels[] = $order->menu_name; // Tambahkan tanggal pesanan ke label
                    $data[] = $order->quantity; // Jumlah pesanan untuk setiap tanggal
                }
            
            return $this->chart->BarChart()
            ->setTitle('Banyaknya Pesanan Menu yang Dimiliki oleh Seller')
            ->setSubtitle('Berdasarkan Akun Penjual yang Sedang Login')
            ->addData('Jumlah Pesanan', $data) // Menggunakan array data
            ->setXAxis($labels);
    }


            
}
