<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:10',
    );

    public function workers() {
        return $this->hasMany(Worker::class);
    }
}
