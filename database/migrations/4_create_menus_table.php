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
        // Pengecekan apakah tabel sudah ada sebelum membuatnya
        if (!Schema::hasTable('table_menu')) {
            Schema::create('table_menu', function (Blueprint $table) {
                $table->id();
                $table->string('menu_pic')->nullable();
                $table->foreignId('category_id')->references('id')->on('table_category');
                $table->foreignId('users_id')->nullable(false)->references('id')->on('users');
                $table->string('seller')->references('nama_lengkap')->on('users');
                $table->string('menu_name');
                $table->integer('menu_price');
                $table->string('menu_desc');
                $table->enum('min_order_time', ['H-1', 'H-2', 'H-3']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_menu');
    }
};
