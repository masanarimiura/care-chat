<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;


    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
    );

    public $timestamps = false;

    public function shops() {
        return $this->hasMany(Shop::class);
    }
}
