<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nguyenlieu extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'ten_nl', 'gia_nl', 'donvi_nl'
    ];
    protected $primaryKey = 'id_nl';
    protected $table = 'nguyenlieu';
}
