<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'matp_fee', 'maqh_fee', 'xaid_fee', 'feeship_fee'
    ];
    protected $primaryKey = 'id_fee';
    protected $table = 'fee_ship';
}
