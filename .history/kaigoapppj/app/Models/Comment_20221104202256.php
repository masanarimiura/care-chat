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
        'created_at' => 'datetime',
    );

    public function threads() {
        return $this->belongsTo(Thread::class);
    }
}
