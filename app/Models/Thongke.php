<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongke extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'order_date', 'doanhso_tk', 'loinhuan_tk', 'soluong_tk', 'total_order'
    ];
    protected $primaryKey = 'id_tk';
    protected $table = 'thongke';
}
