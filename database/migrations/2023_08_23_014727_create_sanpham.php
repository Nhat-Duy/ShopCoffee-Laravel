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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('id_sp');
            $table->integer('id_danhmuc');
            $table->text('ten_sp');
            $table->text('mota_sp');
            $table->text('noidung_sp');
            $table->string('gia_sp');
            $table->string('hinhanh_sp');
            $table->integer('trangthai_sp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
