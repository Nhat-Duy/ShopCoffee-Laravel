<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'id_kh', 'ten_kh', 'sdt_kh', 'email_kh', 'matkhau_kh'
    ];
    protected $primaryKey = 'id_kh';
    protected $table = 'khachhang';
}
