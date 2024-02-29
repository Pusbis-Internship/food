<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'menu_id', 'rating', 'review'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
