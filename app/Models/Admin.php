<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'admin_email', 'admin_password', 'admin_name', 'admin_phone'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'admin';
}
