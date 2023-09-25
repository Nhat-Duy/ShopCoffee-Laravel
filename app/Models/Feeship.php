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

    public function city(){
        return $this->belongsTo('App\Models\City', 'matp_fee');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province', 'maqh_fee');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards', 'xaid_fee');
    }
}
