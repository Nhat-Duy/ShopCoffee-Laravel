<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'ma_dh', 'id_sp', 'ten_sp', 'gia_sp', 'soluong_sp', 'coupon_sp', 'feeship_sp'
    ];
    protected $primaryKey = 'id_ctdh';
    protected $table = 'chitietdonhang';

    public function sanpham(){
        return $this->belongsTo('App\Models\Sanpham', 'id_sp');
    }
}
