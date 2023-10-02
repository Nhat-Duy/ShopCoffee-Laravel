<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'id_danhmuc', 'ten_sp', 'mota_sp', 'noidung_sp', 'gia_sp', 'hinhanh_sp'
    ];
    protected $primaryKey = 'id_sp';
    protected $table = 'sanpham';
}
