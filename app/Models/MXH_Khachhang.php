<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MXH_Khachhang extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'provider_user_id', 'provider_user_email', 'provider', 'user'
    ];

    protected $primaryKey ='user_id';
    protected $table = 'mxh_khachhang';
    public function khachhang(){

        return $this->belongsTo('App\Models\Khachhang', 'user');
    }
}
