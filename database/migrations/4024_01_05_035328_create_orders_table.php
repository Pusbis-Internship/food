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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('users_id')->references('id')->on('users');
                $table->foreignId('menu_id')->nullable(false)->references('id')->on('table_menu');
                $table->string('menu_name');
                $table->string('seller')->nullable(false)->references('seller')->on('table_menu');
                $table->string('menu_pic');
                $table->integer('quantity');
                $table->integer('menu_price')->references('menu_price')->on('table_menu');
                $table->integer('subtotal');
                $table->integer('total');
                $table->integer('id_pesanan')->nullable(); // Kolom untuk menunjukkan grup pesanan
                $table->string('nama_penerima')->nullable(); // Kolom nama_penerima boleh kosong
                $table->string('alamat_pengiriman')->nullable(); // Kolom alamat_pengiriman boleh kosong
                $table->string('fakultas')->nullable(); // Kolom fakultas boleh kosong
                $table->date('tanggal')->nullable(); // Kolom tanggal boleh kosong
                $table->time('jam')->nullable(); // Kolom jam boleh kosong
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
