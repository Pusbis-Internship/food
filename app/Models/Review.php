<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'menu_id', 'id_pesanan', 'rating', 'comment']; 

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

}
