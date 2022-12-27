<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public function relation() {
        return $this->belongsTo(Relation::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function client_patients() {
        return $this->hasMany(ClientPatient::class);
    }

    public function patients(){
        return $this->belongsToMany(Patient::class,'client_patients','client_id','patient_id');
    }
}
