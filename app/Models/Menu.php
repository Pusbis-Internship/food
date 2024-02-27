<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Menu extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table = 'table_menu';
    protected $fillable = [
        'menu_id',
        'menu_pic',
        'menu_name',
        'menu_price',
        'menu_desc',
        'users_id',
        'seller',
        'min_order_time', 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'menu_id'); // Ubah relasi menjadi hasMany karena satu menu bisa memiliki banyak pesanan
    }
}
