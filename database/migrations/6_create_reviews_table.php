<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->references('id')->on('users');
            $table->foreignId('menu_id')->nullable(false)->references('id')->on('table_menu')->onDelete('cascade');
            $table->integer('id_pesanan')->nullable(); 
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
