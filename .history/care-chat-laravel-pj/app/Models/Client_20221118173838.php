<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public function comments(){
        return $this->belongsTo(Relation::class);
    }

    public function relation(){
        return $this->belongsToMany(Patient::class,'relations','client_id','patient_id');
    }
}
