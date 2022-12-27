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
        return $this->belongsToMany(Comment::class,'comments','client_id','patient_id');
    }

    public function relations() {
        return $this->hasMany(Relation::class);
    }

    public function relations(){
        return $this->belongsToMany(Relation::class,'relations','client_id','patient_id');
    }
}
