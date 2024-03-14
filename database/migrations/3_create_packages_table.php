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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('table_category')->onDelete('cascade');
            $table->string('makanan_1')->nullable();
            $table->string('makanan_2')->nullable();
            $table->string('makanan_3')->nullable();
            $table->string('makanan_4')->nullable();
            $table->string('makanan_5')->nullable();
            $table->string('makanan_6')->nullable();
            $table->string('makanan_7')->nullable();
            $table->string('makanan_8')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};