<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhaphang extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'admin_id', 'tinhtrang_nh', 'ma_nh', 'created_at'
    ];
    protected $primaryKey = 'id_nh';
    protected $table = 'nhaphang';
}
