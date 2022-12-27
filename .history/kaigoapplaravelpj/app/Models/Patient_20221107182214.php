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

    public function workers(){
        return $this->belongsToMany(Worker::class,'comments','patient_id','worker_id');
    }

    public function clients(){
        return $this->belongsToMany(Client::class,'comments','patient_id','client_id');
    }

    public function worker_patients() {
        return $this->hasMany(WorkerPatient::class);
    }
    
    public function client_patients() {
        return $this->hasMany(ClientPatient::class);
    }

    

    public function clients_2(){
        return $this->belongsToMany(Client::class,'client_patients','patient_id','client_id');
    }
}
