<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'content' => 'required|max:1000',
        'thread_id' => 'required',
        'thread_id' => 'required',
    );

    public function shops() {
        return $this->belongsTo(Shop::class);
    }
    public function roles() {
        return $this->belongsTo(Role::class);
    }

}
