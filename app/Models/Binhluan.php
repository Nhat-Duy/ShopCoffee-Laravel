<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'binhluan', 'ten_bl', 'ngay_bl', 'id_sp_bl', 'traloi_bl', 'tinhtrang_bl'
    ];
    protected $primaryKey = 'id_bl';
    protected $table = 'binhluan';

    public function sanpham(){
        return $this->belongsTo('App\Models\Sanpham', 'id_sp_bl');
    }
}
