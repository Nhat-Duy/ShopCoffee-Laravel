<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'ten_coupon', 'ma_coupon', 'time_coupon', 'number_coupon', 'dieukien_coupon'
    ];
    protected $primaryKey = 'id_coupon';
    protected $table = 'coupon';
}
