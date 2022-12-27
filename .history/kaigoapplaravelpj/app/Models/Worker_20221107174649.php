<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function worker_patients() {
        return $this->hasMany(WorkerPatient::class);
    }

    public function patients(){
        return $this->belongsToMany(Patient::class,'worker_patients','patient_id','worker_id');
    }
}
