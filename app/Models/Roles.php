<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'name'
    ];
    protected $primaryKey = 'id_roles';
    protected $table = 'roles';

    public function admin(){
        return $this->belongsToMany('App\Models\Admin');
    }
}
