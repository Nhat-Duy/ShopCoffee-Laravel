<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietnhaphang extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'ma_nh', 'id_nl', 'ten_nl', 'gia_nl', 'soluong_nl', 'donvi_nl'
    ];
    protected $primaryKey = 'id_ctnh';
    protected $table = 'chitietnhaphang';

    public function nguyenlieu(){
        return $this->belongsTo('App\Models\Nguyenlieu', 'id_nl');
    }
}
