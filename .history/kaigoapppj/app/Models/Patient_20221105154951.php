<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
        'password' => 'required|min:6|max:256',
    );

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function wos() {
        return $this->hasMany(Comment::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
