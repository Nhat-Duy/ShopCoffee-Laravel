<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thanhtoan extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'ten_tt', 'email_tt', 'sdt_tt', 'diachi_tt', 'notes_tt', 'method_tt'
    ];
    protected $primaryKey = 'id_tt';
    protected $table = 'thanhtoan';
}
