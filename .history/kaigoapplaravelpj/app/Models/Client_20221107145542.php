<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    public static $rules = array(
        'name' => 'required|max:100',
        'relation_id' => 'required',
        'email' =>  'required|max:256|email',
        'number' => 'digits_between:8,11',
        'password' => 'required|min:6|max:256',
    );

    public function relation() {
        return $this->belongsTo(Relation::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function client_patients() {
        return $this->hasMany(ClientPatient::class);
    }
}
