<?php
// app/Models/Package.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'makanan_1', 'makanan_2', 'makanan_3', 'makanan_4',
        'makanan_5', 'makanan_6', 'makanan_7', 'makanan_8',
    ];

    /**
     * Get the category that owns the package.
     */
    public function packageCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
