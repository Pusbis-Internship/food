<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'users_id',
        'seller',
        'menu_id',
        'menu_name',
        'menu_pic',
        'quantity',
        'menu_price',
        'subtotal',
        'total',
        'id_pesanan', 
        'nama_penerima', 
        'alamat_pengiriman', 
        'fakultas', 
        'tanggal', 
        'jam',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}