<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhgiadonhang extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'noidung_dgdh', 'ten_dgdh', 'ngay_dgdh', 'ma_dgdh'
    ];
    protected $primaryKey = 'id_dgdh';
    protected $table = 'danhgiadonhang';

}
