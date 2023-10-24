<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diachi extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'id_dc', 'id_kh', 'diachi_dc'
    ];
    protected $primaryKey = 'id_dc';
    protected $table = 'diachi';
}
