<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhgiasao extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'id_kh', 'id_sp', 'sao'
    ];
    protected $primaryKey = 'id_sao';
    protected $table = 'danhgiasao';
}
