<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function worker_patients() {
        return $this->hasMany(WorkerPatient::class);
    }
    
    public function client_patients() {
        return $this->hasMany(ClientPatient::class);
    }

    public function s(){
        return $this->belongsToMany(Shop::class,'bookings','user_id','shop_id')->withPivot(['datetime','number']);
    }
}
