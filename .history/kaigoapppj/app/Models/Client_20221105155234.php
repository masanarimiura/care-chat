<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
        'relation_id' => 'required',
        'email' =>  'required|max:256|email',
        'number' => 'required|numeric|digits_between:8,11',
        'password' => 'required|min:6|max:256',
    );

    public function relations() {
        return $this->belongsTo(Relation::class);
    }
    
    public function relations() {
        return $this->belongsTo(Relation::class);
    }

}
